<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantStaffAvailability extends Model
{
    protected $table = 'tenant_staff_availability';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'specific_date' => 'date',
            'is_recurring' => 'boolean',
        ];
    }

    public function staff()
    {
        return $this->belongsTo(TenantStaff::class, 'tenant_staff_id');
    }

    public function location()
    {
        return $this->belongsTo(TenantLocation::class, 'location_id');
    }
}
