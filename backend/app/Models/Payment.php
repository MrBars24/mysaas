<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
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
