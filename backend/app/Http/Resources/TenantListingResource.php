<?php

namespace App\Http\Resources;

use App\Domains\TenantCatalog\Enums\BusinessType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantListingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $owner = $this->relationLoaded('owner') ? $this->whenLoaded('owner') : null;
        $businessType = BusinessType::tryFrom($this->business_type);

        return [
            'public_id' => $this->public_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'business_type' => [
                'value' => $this->business_type,
                'label' => $businessType?->label() ?? $this->business_type,
            ],
            'contact_email' => $this->contact_email,
            'contact_phone' => $this->contact_phone,
            'status' => $this->status, // e.g., 'pending_verification', 'active', etc.
            'created_at' => $this->created_at?->toIso8601String(),
            'owner' => $owner ? [
                'public_id' => $owner->public_id,
                'first_name' => $owner->first_name,
                'last_name' => $owner->last_name,
                'email' => $owner->email,
                'phone' => $owner->phone,
                'status' => $owner->status,
            ] : null,
        ];
    }
}