<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_open_to_work' => 'boolean',
            'date_of_birth' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
