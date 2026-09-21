<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;

class UserQualification extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
