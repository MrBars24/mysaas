<?php

namespace App\Domains\Identity\Data;

use App\Domains\Identity\Models\User;

readonly class AuthTokenData
{
    public function __construct(
        public User $user,
        public string $token,
        public string $tokenType = 'Bearer'
    ) {}
}