<?php

namespace App\Domains\Identity\Data;

readonly class ClientLoginData
{
    public function __construct(
        public string $phone,
        public ?string $deviceName = null
    ) {}
}