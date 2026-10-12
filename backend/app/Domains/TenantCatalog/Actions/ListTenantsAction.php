<?php

namespace App\Domains\TenantCatalog\Actions;

use App\Domains\Identity\Models\User;
use App\Domains\TenantCatalog\Data\ListTenantsData;
use App\Domains\TenantCatalog\Models\Tenant;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ListTenantsAction
{
    public function execute(ListTenantsData $data): LengthAwarePaginator
    {
        // 1. Query Tenant Catalog Domain
        $query = Tenant::query();

        if ($data->search) {
            $query->where(function ($q) use ($data) {
                $q->where('name', 'like', "%{$data->search}%")
                  ->orWhere('contact_email', 'like', "%{$data->search}%")
                  ->orWhere('contact_phone', 'like', "%{$data->search}%");
            });
        }

        if ($data->status) {
            $query->where('status', $data->status);
        }

        if ($data->businessType) {
            $query->where('business_type', $data->businessType);
        }

        $paginatedTenants = $query->orderBy('created_at', 'desc')
            ->paginate(perPage: $data->perPage, page: $data->page);

        // 2. Resolve Cross-Domain Soft Reference (owner_user_public_id -> Identity.users)
        $ownerPublicIds = $paginatedTenants->pluck('owner_user_public_id')->filter()->unique();

        $owners = User::whereIn('public_id', $ownerPublicIds)
            ->get()
            ->keyBy('public_id');

        // 3. Attach owner model instance to each tenant item
        $paginatedTenants->getCollection()->transform(function (Tenant $tenant) use ($owners) {
            $tenant->setRelation('owner', $owners->get($tenant->owner_user_public_id));
            return $tenant;
        });

        return $paginatedTenants;
    }
}