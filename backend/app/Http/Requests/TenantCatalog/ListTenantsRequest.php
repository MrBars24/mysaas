<?php

namespace App\Http\Requests\TenantCatalog;

use App\Domains\TenantCatalog\Data\ListTenantsData;
use Illuminate\Foundation\Http\FormRequest;

class ListTenantsRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Add authorization logic e.g., platform super_admin check
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string'],
            'business_type' => ['nullable', 'string'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function toDto(): ListTenantsData
    {
        return new ListTenantsData(
            search: $this->input('search'),
            status: $this->input('status'),
            businessType: $this->input('business_type'),
            perPage: (int) $this->input('per_page', 15),
            page: (int) $this->input('page', 1)
        );
    }
}