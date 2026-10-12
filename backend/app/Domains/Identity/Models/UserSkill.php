<?php

namespace App\Domains\Identity\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserSkill extends Pivot
{
    protected $table = 'user_skills';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skill()
    {
        return $this->belongsTo(GlobalSkill::class, 'global_skill_id');
    }
}
