<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function staff()
    {
        return $this->belongsToMany(TenantStaff::class, 'tenant_staff_services')
                    ->withPivot(['custom_price_amount', 'custom_duration_minutes', 'commission_type', 'commission_rate'])
                    ->withTimestamps();
    }
}
