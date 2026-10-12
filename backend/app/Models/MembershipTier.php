<?php

namespace App\Models;

use App\Domains\TenantCatalog\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipTier extends Model
{
    use SoftDeletes;

    protected $connection = 'identity';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount_percentage' => 'decimal:2',
            'perk_priority_booking' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function memberships()
    {
        return $this->hasMany(ClientMembership::class);
    }
}
