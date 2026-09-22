<?php

namespace App\Http\Controllers\Api\Identity;

use App\Domains\Identity\Actions\LoginClientAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Identity\ClientLoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class ClientLoginController extends Controller
{
    public function __invoke(
        ClientLoginRequest $request,
        LoginClientAction $action
    ): JsonResponse {
        $authTokenData = $action->execute($request->toDto());

        return response()->json([
            'data' => [
                'user' => new UserResource($authTokenData->user),
                'token' => $authTokenData->token,
                'token_type' => $authTokenData->tokenType,
            ],
        ]);
    }
}