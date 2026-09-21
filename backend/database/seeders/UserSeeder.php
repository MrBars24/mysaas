<?php

namespace Database\Seeders;

use App\Domains\Identity\Models\GlobalSkill;
use App\Domains\Identity\Models\User;
use App\Domains\Identity\Models\UserAddress;
use App\Domains\Identity\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Platform Super Admin
        $admin = User::create([
            'public_id' => Str::uuid(),
            'email' => 'admin@platform.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'System',
            'last_name' => 'Admin',
            'platform_role' => 'super_admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Issue Sanctum Token for Admin
        // $admin->createToken('admin-api-token', ['*']);

        // 2. Tenant Owner / Staff User
        $owner = User::create([
            'public_id' => Str::uuid(),
            'email' => 'owner@aircon.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'Sarah',
            'last_name' => 'Jenkins',
            'platform_role' => 'tenant_owner',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // $owner->createToken('tenant-owner-token', ['tenant:manage', 'bookings:read-write']);

        // 3. Client User with Profile & Address
        $client = User::create([
            'public_id' => Str::uuid(),
            'email' => 'client@gmail.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'platform_role' => 'client',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // $client->createToken('mobile-app-token', ['bookings:create', 'reviews:write']);

        UserProfile::create([
            'user_id' => $client->id,
            'is_open_to_work' => false,
            'gender' => 'male',
        ]);

        UserAddress::create([
            'user_id' => $client->id,
            'label' => 'Home',
            'address_line1' => '123 Main Street',
            'city' => 'Metropolis',
            'state_province' => 'NY',
            'postal_code' => '10001',
            'country_code' => 'US',
            'is_default' => true,
        ]);

        // 4. Seed Global Skills
        $skill = GlobalSkill::create([
            'name' => 'Aircon Cleaning',
            'description' => 'Professional aircon cleaner',
        ]);

        $owner->skills()->attach($skill->id, [
            'proficiency_level' => 'expert',
            'years_experience' => 8,
        ]);
    }
}
