<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'public_id' => $this->public_id,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'platform_role' => $this->platform_role,
            'status' => $this->status,
            'mfa_enabled' => (bool) $this->mfa_enabled,
            'last_login_at' => $this->last_login_at?->toIso8601String(),
        ];
    }
}