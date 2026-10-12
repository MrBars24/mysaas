<?php

namespace App\Models;

use App\Domains\Identity\Models\User;
use App\Domains\TenantCatalog\Models\Tenant;
use Illuminate\Database\Eloquent\Model;

class AuthenticationLog extends Model
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
