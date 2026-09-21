<?php

namespace Database\Seeders;

use App\Domains\Identity\Models\User;
use App\Models\Tenant;
use App\Models\TenantLocation;
use App\Models\TenantStaff;
use App\Models\TenantStaffAvailability;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = User::where('email', 'owner@aircon.com')->first();

        // Create Tenant
        $tenant = Tenant::create([
            'public_id' => Str::uuid(),
            'name' => 'Luxe Beauty Salon',
            'slug' => 'luxe-beauty',
            'business_type' => 'Aircon',
            'owner_user_id' => $owner->id,
            'timezone' => 'Asia/Manila',
            'currency' => 'PHP',
            'is_verified' => true,
            'status' => 'active',
        ]);

        // Create Primary Location
        $location = TenantLocation::create([
            'public_id' => Str::uuid(),
            'tenant_id' => $tenant->id,
            'name' => 'Olongapo Branch',
            'address_line1' => '300 Fifth Avenue',
            'city' => 'Olongapo City',
            'state_province' => 'Zambales',
            'postal_code' => '2200',
            'country_code' => 'PH',
            'is_primary' => true,
            'status' => 'active',
        ]);

        // Assign Owner as Staff
        $staff = TenantStaff::create([
            'public_id' => Str::uuid(),
            'tenant_id' => $tenant->id,
            'user_id' => $owner->id,
            'primary_location_id' => $location->id,
            'role' => 'tenant_owner',
            'title' => 'Tenant Owner',
            'status' => 'active',
            'joined_at' => now(),
        ]);

        // Set Recurring Weekly Availability (Monday through Friday, 9 AM - 5 PM)
        for ($day = 1; $day <= 5; $day++) {
            TenantStaffAvailability::create([
                'tenant_staff_id' => $staff->id,
                'location_id' => $location->id,
                'day_of_week' => $day,
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'is_recurring' => true,
            ]);
        }
    }
}
