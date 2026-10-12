<?php

namespace App\Domains\TenantCatalog\Actions;

use App\Domains\Identity\Models\User;
use App\Domains\TenantCatalog\Data\RegisterTenantData;
use App\Domains\TenantCatalog\Models\Tenant;
use App\Domains\TenantCatalog\Models\TenantDocument;
use App\Domains\TenantCatalog\Models\TenantLocation;
use App\Domains\TenantCatalog\Models\TenantStaff;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class RegisterTenantAction
{
    public function execute(RegisterTenantData $data): Tenant
    {
        return DB::transaction(function () use ($data) {
            // Create the Owner User in Identity Domain
            $owner = User::create([
                'public_id' => (string) Str::ulid(),
                'first_name' => $data->firstName,
                'last_name' => $data->lastName,
                'email' => $data->contactEmail,
                'phone' => $data->contactPhone,
                'password' => Hash::make($data->password),
                'platform_role' => 'tenant_owner',
                'status' => 'active',
            ]);

            // Create Tenant Record
            $tenant = Tenant::create([
                'public_id' => (string) Str::ulid(),
                'name' => $data->name,
                'slug' => Str::slug($data->slug),
                'business_type' => $data->businessType,
                'owner_user_id' => $owner->id,
                'contact_email' => $data->contactEmail,
                'contact_phone' => $data->contactPhone,
                'website_url' => $data->websiteUrl,
                'facebook_url' => $data->facebookUrl,
                'timezone' => 'Asia/Manila',
                'currency' => 'PHP',
                'locale' => 'en',
                'status' => 'pending_verification', // Under Review state
            ]);

            // Create Primary Location
            $location = TenantLocation::create([
                'public_id' => (string) Str::ulid(),
                'tenant_id' => $tenant->id,
                'name' => $data->locationName,
                'address_line1' => $data->fullAddress,
                'city' => $data->city,
                'state_province' => $data->stateProvince,
                'country_code' => $data->countryCode,
                'postal_code' => $data->countryCode,// to follow
                'latitude' => $data->latitude,
                'longitude' => $data->longitude,
                'phone' => $data->contactPhone,
                'is_primary' => true,
                'status' => 'active',
            ]);

            // 2. Loop through documents dynamically regardless of type/quantity
            foreach ($data->documents as $document) {
                /** @var \App\Domains\TenantCatalog\Data\DocumentData $document */

                // Store on private disk
                $filePath = $document->file->store('tenant-documents', 'private');

                TenantDocument::create([
                    'public_id'         => (string) Str::ulid(),
                    'tenant_id'         => $tenant->id,
                    'document_type'     => $document->type,
                    'document_number'   => $document->documentNumber,
                    'file_url'           => $filePath,
                    'original_filename' => $document->file->getClientOriginalName(),
                    'mime_type'         => $document->file->getClientMimeType(),
                    'file_size_bytes'   => $document->file->getSize(),
                    'status'            => 'pending',
                    "rejection_reason"  => "active",
                    "reviewed_by_user_id" => 1,
                    "reviewed_at"        => now(),
                ]);
            }

            // 5. Create Tenant Staff Owner Record
            TenantStaff::create([
                'public_id' => (string) Str::ulid(),
                'tenant_id' => $tenant->id,
                'user_id' => $owner->id,
                'primary_location_id' => $location->id,
                'role' => 'branch_admin',
                'title' => 'Owner / Admin',
                'status' => 'active',
                'joined_at' => now(),
            ]);

            return $tenant;
        });
    }
}