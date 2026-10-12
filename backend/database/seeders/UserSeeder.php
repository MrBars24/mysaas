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
        $superadmin = User::create([
            'public_id' => (string) Str::ulid(),
            'email' => 'superadmin@platform.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'System',
            'last_name' => 'Admin',
            'platform_role' => 'super_admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Issue Sanctum Token for Admin
        // $admin->createToken('admin-api-token', ['*']);

        // founder accounts
        $owner = User::create([
            'public_id' => (string) Str::ulid(),
            'email' => 'owner@ramcap.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'Ramcap',
            'last_name' => 'Admin',
            'platform_role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $admin = User::create([
            'public_id' => (string) Str::ulid(),
            'email' => 'admin@ramcap.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'Jin',
            'last_name' => 'Rams',
            'platform_role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $worker = User::create([
            'public_id' => (string) Str::ulid(),
            'email' => 'serviceworker@ramcap.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'Prem',
            'last_name' => 'Doe',
            'platform_role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $frontdesk = User::create([
            'public_id' => (string) Str::ulid(),
            'email' => 'frontdesk@ramcap.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'Farrah',
            'last_name' => 'Doe',
            'platform_role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // sample accounts
        $owner = User::create([
            'public_id' => (string) Str::ulid(),
            'email' => 'owner@aircon.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'Sarah',
            'last_name' => 'Jenkins',
            'platform_role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // 2. Tenant Admin
        $admin = User::create([
            'public_id' => (string) Str::ulid(),
            'email' => 'admin@aircon.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'Jin',
            'last_name' => 'Rams',
            'platform_role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // 2. service provider
        $provider = User::create([
            'public_id' => (string) Str::ulid(),
            'email' => 'serviceworker@aircon.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'Prem',
            'last_name' => 'Doe',
            'platform_role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // 2. front desk
        $frontdesk = User::create([
            'public_id' => (string) Str::ulid(),
            'email' => 'frontdesk@aircon.com',
            'password' => Hash::make('Password123!'),
            'first_name' => 'Farrah',
            'last_name' => 'Doe',
            'platform_role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // $owner->createToken('tenant-owner-token', ['tenant:manage', 'bookings:read-write']);

        // 3. Client User with Profile & Address
        $client = User::create([
            'public_id' => (string) Str::ulid(),
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
