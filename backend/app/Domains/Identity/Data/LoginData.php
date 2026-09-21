<?php

namespace App\Domains\Identity\Data;

readonly class LoginData
{
    public function __construct(
        public string $email,
        public string $password,
        public ?string $deviceName = null
    ) {}
}