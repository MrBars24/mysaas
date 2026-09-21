<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantStaff extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    public function primaryLocation() {
        return $this->belongsTo(TenantLocation::class, 'primary_location_id');
    }

    public function availabilities() {
        return $this->hasMany(TenantStaffAvailability::class);
    }

    public function services() {
        return $this->belongsToMany(Service::class, 'tenant_staff_services')
                    ->withPivot(['custom_price_amount', 'custom_duration_minutes', 'commission_type', 'commission_rate'])
                    ->withTimestamps();
    }
}
