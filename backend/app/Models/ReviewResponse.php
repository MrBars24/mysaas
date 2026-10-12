<?php

namespace App\Models;

use App\Domains\Identity\Models\User;
use Illuminate\Database\Eloquent\Model;

class ReviewResponse extends Model
{
    protected $connection = 'identity';

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
