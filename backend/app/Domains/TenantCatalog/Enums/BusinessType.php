<?php

namespace App\Domains\TenantCatalog\Enums;

enum BusinessType: string
{
    CASE AUTO_REPAIR = 'auto_repair';
    CASE MASSAGE_THERAPY = 'massage_therapy';
    CASE SALON_SPA = 'salon_spa';
    CASE DENTAL_CLINIC = 'dental_clinic';
    CASE AIRCON_SERVICE = 'aircon_service';

    public function label(): string
    {
        return match ($this) {
            self::AUTO_REPAIR => 'Auto Repair Shop',
            self::AIRCON_SERVICE => 'Aircon Service',
            self::SALON_SPA => 'Salon & Spa',
            self::DENTAL_CLINIC => 'Dental Clinic',
            self::MASSAGE_THERAPY => 'Massage Therapy',
        };
    }

    /**
     * Helper to return formatted options for select dropdowns.
     */
    public static function options(): array
    {
        return array_map(fn (self $case) => [
            'value' => $case->value,
            'label' => $case->label(),
        ], self::cases());
    }
}