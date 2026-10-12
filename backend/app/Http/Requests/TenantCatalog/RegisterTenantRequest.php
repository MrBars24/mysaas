<?php

namespace App\Http\Requests\TenantCatalog;

use App\Domains\TenantCatalog\Data\RegisterTenantData;
use Illuminate\Foundation\Http\FormRequest;

class RegisterTenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Owner Credentials
            'owner.fullName' => ['required', 'string', 'max:255'],
            'owner.password' => ['required', 'string', 'min:8'],

            // Tenant Details
            'tenant.name' => ['required', 'string', 'max:255'],
            'tenant.slug' => ['required', 'string', 'max:255', 'unique:tenants,slug'],
            'tenant.contact_email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'tenant.contact_phone' => ['required', 'string', 'max:50'],
            'tenant.website_url' => ['nullable', 'url', 'max:255'],
            'tenant.facebook_url' => ['nullable', 'url', 'max:255'],
            'tenant.business_type' => ['required', 'string'],

            // Location
            'location.name' => ['required', 'string', 'max:255'],
            'location.full_address' => ['required', 'string'],
            'location.city' => ['required', 'string', 'max:255'],
            'location.state_province' => ['required', 'string', 'max:255'],
            'location.country_code' => ['required', 'string', 'size:2'],
            'location.latitude' => ['nullable', 'numeric'],
            'location.longitude' => ['nullable', 'numeric'],

            // Verification Documents
            'documents' => ['nullable', 'array'],
            'documents.*.type' => ['required', 'string'], // e.g. 'sec_dti', 'bir', 'mayors_permit'
            'documents.*.number' => ['nullable', 'string', 'max:255'],
            'documents.*.file' => ['required', 'file', 'mimes:pdf,jpg,png,jpeg', 'max:10240'], // 10MB
            // 'documents.sec_dti.number' => ['nullable', 'string', 'max:100'],
            // 'documents.sec_dti.file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            // 'documents.bir.number' => ['nullable', 'string', 'max:100'],
            // 'documents.bir.file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            // 'documents.mayors_permit.number' => ['nullable', 'string', 'max:100'],
            // 'documents.mayors_permit.file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ];
    }

    public function toDto(): RegisterTenantData
    {
        return RegisterTenantData::fromRequest($this);
    }
}