<?php

namespace App\Domains\TenantCatalog\Data;

use Illuminate\Http\UploadedFile;

readonly class DocumentData
{
    public function __construct(
        public string $type,               // e.g. 'sec_dti', 'bir', 'mayors_permit', 'tin_id'
        public ?string $documentNumber,    // e.g. Registration / Permit / TIN Number
        public UploadedFile $file          // Uploaded file instance
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            type: $data['type'],
            documentNumber: $data['number'] ?? null,
            file: $data['file']
        );
    }
}