<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewResponse extends Model
{
    protected $guarded = ['id'];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function responder()
    {
        return $this->belongsTo(User::class, 'responder_user_id');
    }
}
