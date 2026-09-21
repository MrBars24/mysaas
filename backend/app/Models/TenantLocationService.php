<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TenantLocationService extends Pivot
{
    protected $table = 'tenant_location_services';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'custom_price' => 'decimal:2',
        ];
    }

    public function location()
    {
        return $this->belongsTo(TenantLocation::class, 'tenant_location_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
