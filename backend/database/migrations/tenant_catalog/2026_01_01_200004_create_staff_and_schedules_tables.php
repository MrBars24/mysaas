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
        Schema::create('tenant_staff', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('primary_location_id')->constrained('tenant_locations');
            $table->string('role', 50);
            $table->string('title')->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('status', 50)->default('active');
            $table->timestamp('invited_at')->nullable();
            $table->timestamp('joined_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tenant_staff_documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('document_type', 100);
            $table->string('document_number', 100)->nullable();
            $table->string('file_url');
            $table->string('original_filename');
            $table->string('mime_type', 100);
            $table->bigInteger('file_size_bytes');
            $table->string('status', 50)->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('reviewed_by_user_id')->nullable()->constrained('users');
            $table->timestamp('reviewed_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });

        Schema::create('tenant_staff_availability', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_staff_id')->constrained('tenant_staff')->cascadeOnDelete();
            $table->foreignId('location_id')->constrained('tenant_locations')->cascadeOnDelete();
            $table->tinyInteger('day_of_week')->nullable();
            $table->date('specific_date')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_recurring')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });

        Schema::create('tenant_staff_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_staff_id')->constrained('tenant_staff')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->decimal('custom_price_amount', 10, 2)->nullable();
            $table->integer('custom_duration_minutes')->nullable();
            $table->string('commission_type', 50)->nullable();
            $table->decimal('commission_rate', 5, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });

        Schema::create('tenant_location_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_location_id')->constrained('tenant_locations')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->decimal('custom_price', 10, 2)->nullable();
            $table->integer('custom_duration_minutes')->nullable();
            $table->integer('custom_buffer_time_minutes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });

        Schema::create('schedule_exceptions', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('tenant_staff_id')->nullable()->constrained('tenant_staff')->cascadeOnDelete();
            $table->foreignId('location_id')->nullable()->constrained('tenant_locations')->cascadeOnDelete();
            $table->string('exception_type', 50);
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->boolean('is_available')->default(false);
            $table->text('reason')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_exceptions');
        Schema::dropIfExists('tenant_location_services');
        Schema::dropIfExists('tenant_staff_services');
        Schema::dropIfExists('tenant_staff_availability');
        Schema::dropIfExists('tenant_staff_documents');
    }
};
