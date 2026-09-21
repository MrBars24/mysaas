<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSkill extends Model
{
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills')
                    ->withPivot(['proficiency_level', 'years_experience'])
                    ->withTimestamps();
    }
}
