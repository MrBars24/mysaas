<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Domains\TenantCatalog\Actions\ListTenantsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\TenantCatalog\ListTenantsRequest;
use App\Http\Resources\TenantListingResource;
use Illuminate\Http\JsonResponse;

class ListTenantsController extends Controller
{
    public function __invoke(
        ListTenantsRequest $request,
        ListTenantsAction $action
    ): JsonResponse {
        $tenants = $action->execute($request->toDto());

        return TenantListingResource::collection($tenants)->response();
    }
}