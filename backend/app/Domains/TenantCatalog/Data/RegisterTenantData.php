<?php

namespace App\Domains\TenantCatalog\Data;

use Illuminate\Http\UploadedFile;

readonly class RegisterTenantData
{
    public function __construct(
        // Owner Details
        public string $firstName,
        public string $lastName,
        public string $contactEmail,
        public string $contactPhone,
        public string $password,

        // Tenant Details
        public string $name,
        public string $slug,
        public string $businessType,
        public ?string $websiteUrl,
        public ?string $facebookUrl,

        // Location Details
        public string $locationName,
        public string $fullAddress,
        public string $city,
        public string $stateProvince,
        public string $countryCode,
        public ?float $latitude,
        public ?float $longitude,

        // Document Details (Numbers & Files)
        // public ?string $secDtiNumber,
        // public ?UploadedFile $secDtiFile,
        // public ?string $birNumber,
        // public ?UploadedFile $birFile,
        // public ?string $mayorsPermitNumber,
        // public ?UploadedFile $mayorsPermitFile
        public array $documents = [] // Collection of DocumentData objects
    ) {}

    public static function fromRequest(\App\Http\Requests\TenantCatalog\RegisterTenantRequest $request): self
    {
        logger($request->validated('tenant.contact_email'));
        $documents = array_map(
            fn (array $doc) => DocumentData::fromArray($doc),
            $request->validated('documents', [])
        );

        $fullName = trim($request->validated('owner.fullName'));
        $parts = explode(' ', $fullName);

        $lastName = count($parts) > 1 ? array_pop($parts) : null;
        $firstName = implode(' ', $parts);

        return new self(
            firstName: $firstName,
            lastName: $lastName,
            contactEmail: $request->validated('tenant.contact_email'),
            contactPhone: $request->validated('tenant.contact_phone'),
            password: $request->validated('owner.password'),
            name: $request->validated('tenant.name'),
            slug: $request->validated('tenant.slug'),
            businessType: $request->validated('tenant.business_type'),
            websiteUrl: $request->validated('tenant.website_url'),
            facebookUrl: $request->validated('tenant.facebook_url'),
            locationName: $request->validated('location.name'),
            fullAddress: $request->validated('location.full_address'),
            city: $request->validated('location.city'),
            stateProvince: $request->validated('location.state_province'),
            countryCode: $request->validated('location.country_code'),
            latitude: $request->validated('location.latitude'),
            longitude: $request->validated('location.longitude'),
            documents: $documents
        );
    }
}