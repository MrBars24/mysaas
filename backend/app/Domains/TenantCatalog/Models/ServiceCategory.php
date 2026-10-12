<?php

namespace App\Domains\TenantCatalog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCategory extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant_catalog';

    protected $guarded = ['id'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
