<?php

namespace App\Models;

use App\Domains\TenantCatalog\Models\TenantStaff;
use Illuminate\Database\Eloquent\Model;

class BookingFulfillment extends Model
{
    protected $connection = 'bookings';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function lineItem()
    {
        return $this->belongsTo(BookingLineItem::class, 'booking_service_id');
    }

    public function staff()
    {
        return $this->belongsTo(TenantStaff::class, 'tenant_staff_id');
    }
}
