<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Tenant;
use App\Models\TenantStaff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::first();
        $staff = TenantStaff::first();

        // Category
        $category = ServiceCategory::create([
            'public_id' => Str::uuid(),
            'tenant_id' => $tenant->id,
            'name' => 'Aircon',
            'slug' => 'aircon',
            'sort_order' => 1,
            'status' => 'active',
        ]);

        // Service
        $service = Service::create([
            'public_id' => Str::uuid(),
            'tenant_id' => $tenant->id,
            'service_category_id' => $category->id,
            'name' => 'Aircon Cleaning',
            'slug' => 'aircon-cleaning',
            'duration_minutes' => 30,
            'price_amount' => 300.00,
            'price_currency' => 'PHP',
            'buffer_before_minutes' => 5,
            'buffer_after_minutes' => 10,
            'status' => 'active',
        ]);

        // Attach Service to Staff Member
        $staff->services()->attach($service->id, [
            'custom_price_amount' => 350.00, // Custom staff override
            'custom_duration_minutes' => 25,
            'commission_type' => 'percentage',
            'commission_rate' => 5.00,
            'is_active' => true,
        ]);
    }
}
