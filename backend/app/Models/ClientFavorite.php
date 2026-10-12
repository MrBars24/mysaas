<?php

namespace App\Models;

use App\Domains\Identity\Models\User;
use App\Domains\TenantCatalog\Models\Tenant;
use Illuminate\Database\Eloquent\Model;

class ClientFavorite extends Model
{
    protected $connection = 'identity';

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
