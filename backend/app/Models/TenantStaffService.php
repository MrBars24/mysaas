<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TenantStaffService extends Pivot
{
    protected $table = 'tenant_staff_services';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'custom_price_amount' => 'decimal:2',
            'commission_rate' => 'decimal:2',
        ];
    }

    public function staff()
    {
        return $this->belongsTo(TenantStaff::class, 'tenant_staff_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
