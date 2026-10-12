<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Domains\TenantCatalog\Enums\BusinessType;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class GetTenantOptionsController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'data' => [
                'business_types' => BusinessType::options(),
            ],
        ]);
   }
}