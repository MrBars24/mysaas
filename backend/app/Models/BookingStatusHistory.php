<?php

namespace App\Models;

use App\Domains\Identity\Models\User;
use Illuminate\Database\Eloquent\Model;

class BookingStatusHistory extends Model
{
    protected $connection = 'bookings';

    protected $table = 'booking_status_history';
    public $timestamps = false;
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by_user_id');
    }
}
