<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientFavorite extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_user_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
