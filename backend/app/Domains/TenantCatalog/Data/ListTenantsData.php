<?php

namespace App\Domains\TenantCatalog\Data;

readonly class ListTenantsData
{
    public function __construct(
        public ?string $search = null,
        public ?string $status = null,
        public ?string $businessType = null,
        public int $perPage = 15,
        public int $page = 1
    ) {}
}