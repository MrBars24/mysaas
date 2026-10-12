<?php

namespace App\Models;

use App\Domains\TenantCatalog\Models\Service;
use App\Domains\TenantCatalog\Models\TenantStaff;
use Illuminate\Database\Eloquent\Model;

class BookingLineItem extends Model
{
    protected $connection = 'bookings';

    protected $guarded = ['id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function staff()
    {
        return $this->belongsTo(TenantStaff::class, 'tenant_staff_id');
    }
}
