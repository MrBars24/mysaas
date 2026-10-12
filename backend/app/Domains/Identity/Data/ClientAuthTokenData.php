<?php

namespace App\Domains\Identity\Data;

use App\Domains\Identity\Models\User;
use App\Models\TenantStaff;

readonly class ClientAuthTokenData
{
    public function __construct(
        public User $user,
        public string $token,
        public string $tokenType = 'Bearer'
    ) {}
}