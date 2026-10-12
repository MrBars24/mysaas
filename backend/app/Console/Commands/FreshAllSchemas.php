<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FreshAllSchemas extends Command
{
    protected $signature = 'db:fresh-all {--seed : Seed the database after migrating}';
    protected $description = 'Drop all tables across all 6 schemas and re-run migrations';

    public function handle(): void
    {
        if (app()->environment('production')) {
            $this->error('Wiping database in production is restricted!');
            return;
        }

        $this->warn('Dropping tables across all 6 schemas...');

        // Connections to wipe in order (child schemas first to respect foreign keys)
        $connections = [
            'audit',
            'engagement',
            'commerce',
            'bookings',
            'tenant_catalog',
            'identity',
        ];

        // Disable foreign key checks during drop phase
        foreach ($connections as $connection) {
            $this->info("Wiping connection/schema: {$connection}");

            DB::connection($connection)->statement('SET FOREIGN_KEY_CHECKS = 0;');

            // Fetch all table names in this schema and drop them
            $tables = Schema::connection($connection)->getTableListing();
            foreach ($tables as $table) {
                Schema::connection($connection)->dropIfExists($table);
            }

            DB::connection($connection)->statement('SET FOREIGN_KEY_CHECKS = 1;');
        }

        $this->info('All schemas wiped successfully.');

        // Re-run migrations
        $this->call('migrate');

        // Optionally run seeders
        if ($this->option('seed')) {
            $this->call('db:seed');
        }
    }
}