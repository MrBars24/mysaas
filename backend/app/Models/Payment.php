<?php

namespace App\Models;

use App\Domains\TenantCatalog\Models\Tenant;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $connection = 'commerce';

    protected $guarded = ['id'];

    protected function casts(): array {
        return [
            'payment_metadata' => 'array',
            'paid_at' => 'datetime',
        ];
    }

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    public function booking() {
        return $this->belongsTo(Booking::class);
    }
}
