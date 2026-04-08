<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'logo_path',
        'favicon_path',
        'footer_note',
        'footer_copyright',
        'contact_email',
        'contact_phone',
        'contact_address',
        'instagram_url',
        'facebook_url',
        'youtube_url',
        'x_url',
        'institution_logos',
    ];

    protected function casts(): array
    {
        return [
            'institution_logos' => 'array',
        ];
    }

    public const CACHE_KEY = 'site_settings.current';

    public static function defaults(): array
    {
        return [
            'site_name' => 'Portal Pilrek Unmul',
            'site_tagline' => 'Pemilihan Rektor 2026-2030',
            'logo_path' => null,
            'favicon_path' => null,
            'footer_note' => 'Portal resmi informasi Pemilihan Rektor Universitas Mulawarman.',
            'footer_copyright' => 'Portal Pemilihan Rektor Universitas Mulawarman',
            'contact_email' => 'pilrek2026@universitas.ac.id',
            'contact_phone' => '+62 541 000000',
            'contact_address' => 'Gedung Rektorat Lt. 2, Universitas Mulawarman',
            'instagram_url' => null,
            'facebook_url' => null,
            'youtube_url' => null,
            'x_url' => null,
            'institution_logos' => self::defaultInstitutionLogos(),
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function defaultInstitutionLogos(): array
    {
        return [
            [
                'logo_order' => 1,
                'name' => 'Tut Wuri',
                'path' => 'tut-wuri.png',
                'is_active' => true,
            ],
            [
                'logo_order' => 2,
                'name' => 'Universitas Mulawarman',
                'path' => 'unmul.png',
                'is_active' => true,
            ],
            [
                'logo_order' => 3,
                'name' => 'BLU',
                'path' => 'blu.png',
                'is_active' => true,
            ],
            [
                'logo_order' => 4,
                'name' => 'Dies Natalis',
                'path' => 'dies-natalis.png',
                'is_active' => true,
            ],
            [
                'logo_order' => 5,
                'name' => 'Diktisaintek',
                'path' => 'diktisaintek.png',
                'is_active' => true,
            ],
            [
                'logo_order' => 6,
                'name' => 'Logo Unggul',
                'path' => 'logo-unggul.png',
                'is_active' => true,
            ],
        ];
    }

    public static function current(): self
    {
        /** @var self $settings */
        $settings = Cache::rememberForever(self::CACHE_KEY, function (): self {
            return self::query()->firstOrCreate([], self::defaults());
        });

        return $settings;
    }

    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
