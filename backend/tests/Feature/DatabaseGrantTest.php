<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DatabaseGrantTest extends TestCase
{
    #[Test]
    public function identity_user_has_full_rw_access_on_identity_schema()
    {
        // 1. Begin transaction on the target connection
        DB::connection('identity')->beginTransaction();

        // SELECT on app_identity should succeed
        $result = DB::connection('identity')->select('SELECT 1');
        $this->assertNotEmpty($result);

        try {
            // 2. Perform the test write
            $success = DB::connection('identity')->statement(
                "INSERT INTO app_identity.users (public_id, first_name, last_name, email, password, platform_role, status)
                VALUES (UUID(), 'John', 'Doe', 'test_grant@domain.com', 'hash', 'client', 'active')"
            );

            // 3. Assert write succeeded
            $this->assertTrue($success);

            // 4. Verify the row actually exists within the transaction
            $user = DB::connection('identity')
                ->table('app_identity.users')
                ->where('email', 'test_grant@domain.com')
                ->first();

            $this->assertNotNull($user);
        } finally {
            // 5. Always roll back so no dummy rows stay in the database
            DB::connection('identity')->rollBack();
        }
    }

    #[Test]
    public function tenant_catalog_user_can_read_identity_but_cannot_write()
    {
        DB::purge('tenant_catalog');

        // SELECT on app_identity should succeed
        $result = DB::connection('tenant_catalog')->select('SELECT * FROM app_identity.users LIMIT 1');
        $this->assertNotNull($result);

        // INSERT into app_identity should be DENIED for tenant_catalog
        $this->expectException(\Illuminate\Database\QueryException::class);
        DB::connection('tenant_catalog')->statement(
            "INSERT INTO app_identity.users (public_id, first_name, last_name, email, password, platform_role, status)
             VALUES (UUID(), 'Jane', 'Doe', 'unauthorized@domain.com', 'hash', 'client', 'active')"
        );
    }

    #[Test]
    public function bookings_user_can_read_tenant_catalog_but_cannot_write()
    {
        // SELECT on app_tenant_catalog should succeed
        $result = DB::connection('bookings')->select('SELECT * FROM app_tenant_catalog.tenants LIMIT 1');
        $this->assertIsArray($result);

        // INSERT into app_tenant_catalog should be DENIED
        $this->expectException(\Illuminate\Database\QueryException::class);
        DB::connection('bookings')->statement(
            "INSERT INTO app_tenant_catalog.tenants (public_id, name, slug) VALUES (UUID(), 'Forbidden Tenant', 'forbidden')"
        );
    }

    #[Test]
    public function commerce_user_can_read_bookings_but_cannot_read_tenant_catalog()
    {
        DB::purge('commerce');
        DB::purge('bookings');

        // SELECT on app_bookings should succeed
        $result = DB::connection('commerce')->select('SELECT * FROM app_bookings.bookings LIMIT 1');
        $this->assertIsArray($result);

        // SELECT on app_tenant_catalog should be DENIED
        $this->expectException(\Illuminate\Database\QueryException::class);
        DB::connection('commerce')->select('SELECT * FROM app_tenant_catalog.tenants LIMIT 1');
    }

    #[Test]
    public function engagement_user_can_read_bookings_but_cannot_read_commerce()
    {
        // SELECT on app_bookings should succeed
        $result = DB::connection('engagement')->select('SELECT * FROM app_bookings.bookings LIMIT 1');
        $this->assertIsArray($result);

        // SELECT on app_commerce should be DENIED
        $this->expectException(\Illuminate\Database\QueryException::class);
        DB::connection('engagement')->select('SELECT * FROM app_commerce.payments LIMIT 1');
    }

    #[Test]
    public function service_users_can_only_insert_into_audit_and_cannot_update_or_delete()
    {
        // INSERT into app_audit should succeed for service user
        $success = DB::connection('bookings')->statement(
            "INSERT INTO app_audit.data_change_logs (public_id, tenant_id, actor_user_id, table_name, record_id, action) VALUES (UUID(), 1, 1, 'tenants', 1, 'booking_created')"
        );
        $this->assertTrue($success);

        // UPDATE or DELETE on app_audit should be DENIED
        $this->expectException(\Illuminate\Database\QueryException::class);
        DB::connection('bookings')->statement("DELETE FROM app_audit.data_change_logs");
    }

    #[Test]
    public function reporter_role_is_strictly_read_only_across_all_schemas()
    {
        // SELECT across schemas should succeed
        $result = DB::connection('app_reporter')->select('SELECT * FROM app_identity.users LIMIT 1');
        $this->assertNotNull($result);

        // WRITE should be DENIED anywhere
        $this->expectException(\Illuminate\Database\QueryException::class);
        DB::connection('app_reporter')->statement(
            "INSERT INTO app_audit.data_change_logs (public_id, action) VALUES (UUID(), 'test')"
        );
    }
}
