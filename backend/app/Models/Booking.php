<?php

namespace App\Models;

use App\Domains\Identity\Models\User;
use App\Domains\TenantCatalog\Models\Tenant;
use App\Domains\TenantCatalog\Models\TenantLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $connection = 'bookings';

    protected $guarded = ['id'];

    public function lineItems()
    {
        return $this->hasMany(BookingLineItem::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_user_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function location()
    {
        return $this->belongsTo(TenantLocation::class);
    }
}
