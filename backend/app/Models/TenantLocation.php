<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantLocation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'is_primary' => 'boolean',
        ];
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function staff()
    {
        return $this->hasMany(TenantStaff::class, 'primary_location_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'tenant_location_services')
                    ->withPivot(['custom_price', 'custom_duration_minutes', 'custom_buffer_time_minutes', 'is_active'])
                    ->withTimestamps();
    }
}
