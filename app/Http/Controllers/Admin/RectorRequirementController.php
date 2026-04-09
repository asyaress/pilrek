<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RectorRequirement;
use App\Support\AdminActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RectorRequirementController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:180'],
            'active' => ['nullable', 'in:all,1,0'],
        ]);

        $query = RectorRequirement::query()
            ->when(
                !empty($filters['q']),
                function ($builder) use ($filters): void {
                    $term = trim((string) $filters['q']);
                    $builder->where(function ($inner) use ($term): void {
                        $inner->where('label', 'like', '%' . $term . '%')
                            ->orWhere('title', 'like', '%' . $term . '%')
                            ->orWhere('description', 'like', '%' . $term . '%');
                    });
                }
            )
            ->when(
                ($filters['active'] ?? 'all') !== 'all',
                fn ($builder) => $builder->where('is_active', ($filters['active'] ?? 'all') === '1')
            );

        return view('pages.admin.requirements.index', [
            'requirements' => $query->ordered()->paginate(10)->withQueryString(),
            'iconOptions' => RectorRequirement::iconOptions(),
            'filters' => [
                'q' => $filters['q'] ?? '',
                'active' => $filters['active'] ?? 'all',
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['requirement_order'] = (int) RectorRequirement::query()->max('requirement_order') + 1;
        $data['details'] = $this->parseDetails($request->input('details_input'));
        $data['is_active'] = $request->boolean('is_active');

        unset($data['details_input']);

        $requirement = RectorRequirement::create($data);

        AdminActivityLogger::log(
            'requirement.create',
            'Menambahkan persyaratan calon rektor.',
            $requirement,
            ['title' => $requirement->title, 'order' => $requirement->requirement_order],
            $request
        );

        return redirect()->route('admin.requirements.index')
            ->with('status', 'Persyaratan berhasil ditambahkan.');
    }

    public function edit(RectorRequirement $requirement): View
    {
        return view('pages.admin.requirements.edit', [
            'requirement' => $requirement,
            'detailsInput' => implode(PHP_EOL, $requirement->details ?? []),
            'iconOptions' => RectorRequirement::iconOptions(),
        ]);
    }

    public function update(Request $request, RectorRequirement $requirement): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['details'] = $this->parseDetails($request->input('details_input'));
        $data['is_active'] = $request->boolean('is_active');

        unset($data['details_input']);

        $requirement->update($data);

        AdminActivityLogger::log(
            'requirement.update',
            'Memperbarui persyaratan calon rektor.',
            $requirement,
            ['title' => $requirement->title, 'order' => $requirement->requirement_order],
            $request
        );

        return redirect()->route('admin.requirements.index')
            ->with('status', 'Persyaratan berhasil diperbarui.');
    }

    public function destroy(Request $request, RectorRequirement $requirement): RedirectResponse
    {
        $snapshot = [
            'title' => $requirement->title,
            'order' => $requirement->requirement_order,
        ];

        $requirement->delete();
        $this->normalizeOrder();

        AdminActivityLogger::log(
            'requirement.delete',
            'Menghapus persyaratan calon rektor.',
            null,
            $snapshot,
            $request
        );

        return redirect()->route('admin.requirements.index')
            ->with('status', 'Persyaratan berhasil dihapus.');
    }

    public function move(Request $request, RectorRequirement $requirement): RedirectResponse
    {
        $direction = $request->validate([
            'direction' => ['required', 'in:up,down'],
        ])['direction'];

        $swapWith = RectorRequirement::query()
            ->when(
                $direction === 'up',
                fn ($query) => $query->where('requirement_order', '<', $requirement->requirement_order)->orderByDesc('requirement_order'),
                fn ($query) => $query->where('requirement_order', '>', $requirement->requirement_order)->orderBy('requirement_order')
            )
            ->first();

        if ($swapWith) {
            $currentOrder = $requirement->requirement_order;
            $requirement->update(['requirement_order' => $swapWith->requirement_order]);
            $swapWith->update(['requirement_order' => $currentOrder]);

            AdminActivityLogger::log(
                'requirement.reorder',
                'Mengubah urutan persyaratan calon rektor.',
                $requirement,
                [
                    'direction' => $direction,
                    'from_order' => $currentOrder,
                    'to_order' => $requirement->requirement_order,
                ],
                $request
            );
        }

        return redirect()->back();
    }

    /**
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'label' => ['required', 'string', 'max:160'],
            'title' => ['required', 'string', 'max:220'],
            'description' => ['required', 'string'],
            'details_input' => ['nullable', 'string'],
            'icon_class' => ['required', 'string', Rule::in(array_keys(RectorRequirement::iconOptions()))],
            'tab_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'gradient_start' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'gradient_middle' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'gradient_end' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);
    }

    /**
     * @return array<int, string>
     */
    private function parseDetails(?string $input): array
    {
        if (!is_string($input) || trim($input) === '') {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', $input) ?: [];
        $items = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            $items[] = $line;
        }

        return $items;
    }

    private function normalizeOrder(): void
    {
        $items = RectorRequirement::query()->ordered()->get();

        foreach ($items as $index => $item) {
            $newOrder = $index + 1;
            if ($item->requirement_order !== $newOrder) {
                $item->update(['requirement_order' => $newOrder]);
            }
        }
    }
}
