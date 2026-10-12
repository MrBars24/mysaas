<?php

namespace App\Models;

use App\Domains\Identity\Models\User;
use App\Domains\TenantCatalog\Models\Tenant;
use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    protected $connection = 'identity';

    protected $table = 'notifications_log';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
        ];
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_user_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
