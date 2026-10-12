<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Domains\TenantCatalog\Actions\RegisterTenantAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\TenantCatalog\RegisterTenantRequest;
use Illuminate\Http\JsonResponse;

class RegisterTenantController extends Controller
{
    public function __invoke(
        RegisterTenantRequest $request,
        RegisterTenantAction $action
    ): JsonResponse {
        $tenant = $action->execute($request->toDto());

    return response()->json([
            'message' => 'Tenant onboarding application submitted successfully.',
            'data' => [
                'public_id' => $tenant->public_id,
                'name' => $tenant->name,
                'slug' => $tenant->slug,
                'status' => $tenant->status,
            ],
        ], 201);
    }
}