<?php

namespace App\Models;

use App\Domains\TenantCatalog\Models\Tenant;
use App\Domains\TenantCatalog\Models\TenantLocation;
use App\Domains\TenantCatalog\Models\TenantStaff;
use Illuminate\Database\Eloquent\Model;

class ScheduleException extends Model
{
    protected $connection = 'identity';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'start_at' => 'datetime',
            'end_at' => 'datetime',
            'is_available' => 'boolean',
        ];
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
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
