<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = ['active_slug'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function locations()
    {
        return $this->hasMany(TenantLocation::class);
    }

    public function staff()
    {
        return $this->hasMany(TenantStaff::class);
    }

    public function serviceCategories()
    {
        return $this->hasMany(ServiceCategory::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
