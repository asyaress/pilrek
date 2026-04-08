<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\AdminActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    /**
     * Show settings form.
     */
    public function edit(): View
    {
        return view('pages.admin.settings', [
            'settings' => SiteSetting::current(),
        ]);
    }

    /**
     * Update settings data.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:150'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'footer_note' => ['nullable', 'string'],
            'footer_copyright' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_address' => ['nullable', 'string'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'x_url' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'favicon' => ['nullable', 'file', 'mimes:ico,png,webp', 'max:1024'],
            'institution_logos' => ['nullable', 'array'],
            'institution_logos.*.name' => ['nullable', 'string', 'max:120'],
            'institution_logos.*.logo_order' => ['nullable', 'integer', 'min:1', 'max:99'],
            'institution_logos.*.existing_path' => ['nullable', 'string', 'max:255'],
            'institution_logos.*.is_active' => ['nullable', 'in:0,1'],
            'institution_logos.*.remove' => ['nullable', 'in:0,1'],
            'institution_logos.*.file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ]);

        $settings = SiteSetting::current();

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $this->storeAsset($request->file('logo'), 'logo');
        }

        if ($request->hasFile('favicon')) {
            $validated['favicon_path'] = $this->storeAsset($request->file('favicon'), 'favicon');
        }

        $validated['institution_logos'] = $this->buildInstitutionLogosPayload($request);

        unset($validated['logo'], $validated['favicon']);

        $settings->fill($validated);
        $settings->save();

        SiteSetting::clearCache();

        AdminActivityLogger::log(
            'settings.update',
            'Pengaturan situs diperbarui.',
            $settings,
            ['site_name' => $settings->site_name],
            $request
        );

        return redirect()
            ->route('admin.settings.edit')
            ->with('status', 'Pengaturan situs berhasil diperbarui.');
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function buildInstitutionLogosPayload(Request $request): array
    {
        $rawItems = $request->input('institution_logos', []);
        if (!is_array($rawItems)) {
            return SiteSetting::defaultInstitutionLogos();
        }

        $items = [];

        foreach ($rawItems as $index => $item) {
            if (!is_array($item)) {
                continue;
            }

            if (($item['remove'] ?? '0') === '1') {
                continue;
            }

            $name = trim((string) ($item['name'] ?? ''));
            $path = trim((string) ($item['existing_path'] ?? ''));
            $isActive = (string) ($item['is_active'] ?? '1') === '1';
            $logoOrder = (int) ($item['logo_order'] ?? ($index + 1));
            if ($logoOrder < 1) {
                $logoOrder = $index + 1;
            }

            if ($request->hasFile("institution_logos.$index.file")) {
                $path = $this->storeAsset($request->file("institution_logos.$index.file"), 'institution-logo');
            }

            if ($path === '') {
                continue;
            }

            $items[] = [
                'logo_order' => $logoOrder,
                'name' => $name !== '' ? $name : ('Logo Institusi ' . (count($items) + 1)),
                'path' => $path,
                'is_active' => $isActive,
            ];
        }

        if (empty($items)) {
            return SiteSetting::defaultInstitutionLogos();
        }

        usort($items, static fn (array $a, array $b): int => ($a['logo_order'] <=> $b['logo_order']));

        foreach ($items as $idx => &$item) {
            $item['logo_order'] = $idx + 1;
        }
        unset($item);

        return $items;
    }

    private function storeAsset(UploadedFile $file, string $prefix): string
    {
        $filename = $prefix . '-' . now()->format('YmdHis') . '-' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $storedPath = $file->storeAs('settings', $filename, 'public');
        if ($storedPath === false) {
            return '';
        }

        return 'storage/' . $storedPath;
    }
}
