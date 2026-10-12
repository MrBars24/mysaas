<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TenantSeeder::class,
            ServiceSeeder::class,
            BookingSeeder::class,
        ]);

        // User::factory(10)->create();

        // User::firstOrCreate(
        //     ['email' => 'admin@example.com'],
        //     [
        //         'name' => 'Default Admin',
        //         'password' => Hash::make('password123'),
        //         'email_verified_at' => now(),
        //     ]
        // );

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
