<?php

namespace Database\Seeders;

use App\Domains\Identity\Models\User;
use App\Models\Booking;
use App\Models\BookingLineItem;
use App\Models\BookingStatusHistory;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Tenant;
use App\Models\TenantLocation;
use App\Models\TenantStaff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::first();
        $location = TenantLocation::first();
        $client = User::where('email', 'client@gmail.com')->first();
        $staff = TenantStaff::first();
        $service = Service::first();

        // 1. Create Main Booking Record
        $booking = Booking::create([
            'public_id' => Str::uuid(),
            'tenant_id' => $tenant->id,
            'location_id' => $location->id,
            'client_user_id' => $client->id,
            'booking_number' => 'BK-' . strtoupper(Str::random(8)),
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'total_amount' => 300.00,
            'tax_amount' => 0.00,
            'discount_amount' => 0.00,
            'net_amount' => 300.00,
            'price_currency' => 'PHP',
            'customer_notes' => 'First time client.',
        ]);

        // 2. Create Reserved Time Slot Line Item
        BookingLineItem::create([
            'public_id' => Str::uuid(),
            'booking_id' => $booking->id,
            'service_id' => $service->id,
            'tenant_staff_id' => $staff->id,
            'service_name_snapshot' => $service->name,
            'price_snapshot' => 300.00,
            'duration_minutes_snapshot' => 30,
            'start_at' => now()->addDays(1)->setHour(10)->setMinute(0)->setSecond(0),
            'end_at' => now()->addDays(1)->setHour(11)->setMinute(0)->setSecond(0),
            'status' => 'confirmed',
        ]);

        // 3. Log Initial Status Transition
        BookingStatusHistory::create([
            'booking_id' => $booking->id,
            'old_status' => 'pending',
            'new_status' => 'confirmed',
            'changed_by_user_id' => $client->id,
            'reason' => 'Online checkout completed.',
        ]);

        // 4. Create Payment Transaction Record
        Payment::create([
            'public_id' => Str::uuid(),
            'tenant_id' => $tenant->id,
            'booking_id' => $booking->id,
            'payment_type' => 'booking_checkout',
            'payment_method' => 'card',
            'payment_gateway' => 'stripe',
            'gateway_transaction_id' => 'ch_' . Str::random(24),
            'gross_amount' => 300.00,
            'discount_amount' => 0.00,
            'net_amount' => 300.00,
            'currency' => 'PHP',
            'status' => 'succeeded',
            'paid_at' => now(),
            'payment_metadata' => ['card_brand' => 'visa', 'last4' => '4242'],
        ]);
    }
}
