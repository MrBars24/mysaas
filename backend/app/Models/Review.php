<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function response() {
        return $this->hasOne(ReviewResponse::class);
    }

    public function client() {
        return $this->belongsTo(User::class, 'client_user_id');
    }
}
