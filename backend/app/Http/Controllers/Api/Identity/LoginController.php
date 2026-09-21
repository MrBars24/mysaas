<?php

namespace App\Http\Controllers\Api\Identity;

use App\Domains\Identity\Actions\LoginUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Identity\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(
        LoginRequest $request,
        LoginUserAction $action
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
