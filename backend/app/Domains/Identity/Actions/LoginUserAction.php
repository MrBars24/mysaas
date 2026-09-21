<?php

namespace App\Domains\Identity\Actions;

use App\Domains\Identity\Data\AuthTokenData;
use App\Domains\Identity\Data\LoginData;
use App\Domains\Identity\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class LoginUserAction
{
    public function execute(LoginData $data): AuthTokenData
    {
        // 1. Locate user in Identity domain
        $user = User::where('email', $data->email)->first();

        // 2. Validate credentials & active status
        if (! $user || ! Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages    ([
                'email' => [__('auth.failed')],
            ]);
        }

        if ($user->status !== 'active') {
            throw ValidationException::withMessages([
                'email' => [__('Your account is currently inactive or suspended.')],
            ]);
        }

        // 3. Update login timestamp
        $user->forceFill([
            'last_login_at' => now(),
        ])->save();

        // 4. Issue Sanctum Token
        $tokenName = $data->deviceName ?? 'nuxt4_client';
        $plainTextToken = $user->createToken($tokenName)->plainTextToken;

        return new AuthTokenData(
            user: $user,
            token: $plainTextToken
        );
    }
}