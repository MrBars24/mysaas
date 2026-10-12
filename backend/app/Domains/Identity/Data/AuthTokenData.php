<?php

namespace App\Domains\Identity\Data;

use App\Domains\Identity\Models\User;
use App\Domains\TenantCatalog\Models\TenantStaff;

readonly class AuthTokenData
{
    public function __construct(
        public User $user,
        public TenantStaff|null $staff,
        public string $token,
        public string $tokenType = 'Bearer'
    ) {}
}