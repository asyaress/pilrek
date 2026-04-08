<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view): void {
            try {
                $settings = SiteSetting::current();

                /** @var Collection<int, array<string, mixed>> $logos */
                $logos = collect($settings->institution_logos)
                    ->filter(static fn ($item): bool => is_array($item))
                    ->map(static function (array $item, int $index): array {
                        return [
                            'logo_order' => (int) ($item['logo_order'] ?? ($index + 1)),
                            'name' => trim((string) ($item['name'] ?? 'Logo Institusi')),
                            'path' => trim((string) ($item['path'] ?? '')),
                            'is_active' => (bool) ($item['is_active'] ?? true),
                        ];
                    })
                    ->filter(static fn (array $item): bool => $item['path'] !== '')
                    ->sortBy('logo_order')
                    ->values();

                if ($logos->isEmpty()) {
                    $logos = collect(SiteSetting::defaultInstitutionLogos());
                }

                $view->with('siteSettings', $settings);
                $view->with('institutionLogos', $logos->all());
            } catch (Throwable) {
                $view->with('siteSettings', null);
                $view->with('institutionLogos', SiteSetting::defaultInstitutionLogos());
            }
        });
    }
}
