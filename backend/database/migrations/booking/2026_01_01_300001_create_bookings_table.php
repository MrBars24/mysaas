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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->foreignId('tenant_id')->constrained('tenants');
            $table->foreignId('location_id')->constrained('tenant_locations');
            $table->foreignId('client_user_id')->constrained('users');
            $table->string('booking_number', 50)->unique();
            $table->string('status', 50)->default('pending');
            $table->string('payment_status', 50)->default('unpaid');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('net_amount', 10, 2);
            $table->string('price_currency', 3)->default('USD');
            $table->text('customer_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->foreignId('cancelled_by_user_id')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('booking_line_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('tenant_staff_id')->constrained('tenant_staff');
            $table->string('service_name_snapshot');
            $table->decimal('price_snapshot', 10, 2);
            $table->integer('duration_minutes_snapshot');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('status', 50)->default('confirmed');
            $table->timestamps();

            // Overlap check composite index
            $table->index(['tenant_staff_id', 'status', 'start_at', 'end_at'], 'idx_staff_schedule_lookup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_line_items');
        Schema::dropIfExists('bookings');
    }
};
