<?php

namespace App\Domains\Identity\Actions;

use App\Domains\Identity\Data\AuthTokenData;
use App\Domains\Identity\Data\ClientLoginData;
use App\Domains\Identity\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class LoginClientAction
{
    public function execute(ClientLoginData $data): AuthTokenData
    {
        // 1. Find or create the client user by phone
        $user = User::firstOrCreate(
            ['phone' => $data->phone],
            [
                'public_id' => (string) Str::ulid(),
                'platform_role' => 'standard_user',
                'status' => 'active',
            ]
        );

        // 2. Validate active status
        if ($user->status !== 'active') {
            throw ValidationException::withMessages([
                'phone' => [__('Your account is currently inactive or suspended.')],
            ]);
        }

        // 3. Update last login timestamp
        $user->forceFill([
            'last_login_at' => now(),
        ])->save();

        // 4. Issue Sanctum token
        $tokenName = $data->deviceName ?? 'client_portal';
        $plainTextToken = $user->createToken($tokenName)->plainTextToken;

        return new AuthTokenData(
            user: $user,
            token: $plainTextToken
        );
    }
}