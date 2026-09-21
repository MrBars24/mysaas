<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->string('name');
            $table->string('slug', 100);

            // Virtual column & unique index for soft-deleted slug handling
            $table->rawColumn('active_slug', 'VARCHAR(100) GENERATED ALWAYS AS (IF(deleted_at IS NULL, slug, NULL)) STORED');
            $table->unique('active_slug', 'uk_active_tenant_slug');

            $table->string('business_type', 100);
            $table->foreignId('owner_user_id')->constrained('users');
            $table->string('timezone')->default('UTC');
            $table->string('currency', 3)->default('USD');
            $table->string('locale', 10)->default('en');
            $table->string('contact_email')->nullable();
            $table->string('contact_phone', 50)->nullable();
            $table->string('logo_url')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('status', 50)->default('active');

            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
