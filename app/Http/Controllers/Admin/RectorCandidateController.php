<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RectorCandidate;
use App\Support\AdminActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RectorCandidateController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:180'],
            'active' => ['nullable', 'in:all,1,0'],
        ]);

        $query = RectorCandidate::query()
            ->when(
                !empty($filters['q']),
                function ($builder) use ($filters): void {
                    $term = trim((string) $filters['q']);
                    $builder->where(function ($inner) use ($term): void {
                        $inner->where('name', 'like', '%' . $term . '%')
                            ->orWhere('role_summary', 'like', '%' . $term . '%')
                            ->orWhere('faculty_unit', 'like', '%' . $term . '%')
                            ->orWhere('study_program', 'like', '%' . $term . '%');
                    });
                }
            )
            ->when(
                ($filters['active'] ?? 'all') !== 'all',
                fn ($builder) => $builder->where('is_active', $filters['active'] === '1')
            );

        return view('pages.admin.candidates.index', [
            'candidates' => $query->ordered()->paginate(10)->withQueryString(),
            'filters' => [
                'q' => $filters['q'] ?? '',
                'active' => $filters['active'] ?? 'all',
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->makeUniqueSlug($data['name']);
        $data['candidate_order'] = (int) RectorCandidate::query()->max('candidate_order') + 1;
        $data['missions'] = $this->parseMissions($request->input('missions_input'));
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $this->storePhoto($request->file('photo'));
        }

        unset($data['photo'], $data['missions_input']);

        $candidate = RectorCandidate::create($data);

        AdminActivityLogger::log(
            'candidate.create',
            'Menambahkan calon rektor baru.',
            $candidate,
            ['name' => $candidate->name, 'order' => $candidate->candidate_order],
            $request
        );

        return redirect()->route('admin.candidates.index')
            ->with('status', 'Calon rektor berhasil ditambahkan.');
    }

    public function edit(RectorCandidate $candidate): View
    {
        return view('pages.admin.candidates.edit', [
            'candidate' => $candidate,
            'missionsInput' => $this->missionsToTextarea($candidate->missions ?? []),
        ]);
    }

    public function update(Request $request, RectorCandidate $candidate): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->makeUniqueSlug($data['name'], $candidate->id);
        $data['missions'] = $this->parseMissions($request->input('missions_input'));
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $this->storePhoto($request->file('photo'));
        }

        unset($data['photo'], $data['missions_input']);

        $candidate->update($data);

        AdminActivityLogger::log(
            'candidate.update',
            'Memperbarui data calon rektor.',
            $candidate,
            ['name' => $candidate->name, 'order' => $candidate->candidate_order],
            $request
        );

        return redirect()->route('admin.candidates.index')
            ->with('status', 'Calon rektor berhasil diperbarui.');
    }

    public function destroy(Request $request, RectorCandidate $candidate): RedirectResponse
    {
        $snapshot = [
            'name' => $candidate->name,
            'order' => $candidate->candidate_order,
        ];

        $candidate->delete();
        $this->normalizeOrder();

        AdminActivityLogger::log(
            'candidate.delete',
            'Menghapus calon rektor.',
            null,
            $snapshot,
            $request
        );

        return redirect()->route('admin.candidates.index')
            ->with('status', 'Calon rektor berhasil dihapus.');
    }

    public function move(Request $request, RectorCandidate $candidate): RedirectResponse
    {
        $direction = $request->validate([
            'direction' => ['required', 'in:up,down'],
        ])['direction'];

        $swapWith = RectorCandidate::query()
            ->when(
                $direction === 'up',
                fn ($query) => $query->where('candidate_order', '<', $candidate->candidate_order)->orderByDesc('candidate_order'),
                fn ($query) => $query->where('candidate_order', '>', $candidate->candidate_order)->orderBy('candidate_order')
            )
            ->first();

        if ($swapWith) {
            $currentOrder = $candidate->candidate_order;
            $candidate->update(['candidate_order' => $swapWith->candidate_order]);
            $swapWith->update(['candidate_order' => $currentOrder]);

            AdminActivityLogger::log(
                'candidate.reorder',
                'Mengubah urutan calon rektor.',
                $candidate,
                [
                    'direction' => $direction,
                    'from_order' => $currentOrder,
                    'to_order' => $candidate->candidate_order,
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
            'name' => ['required', 'string', 'max:180'],
            'role_summary' => ['nullable', 'string', 'max:200'],
            'faculty_unit' => ['nullable', 'string', 'max:180'],
            'study_program' => ['nullable', 'string', 'max:180'],
            'academic_position' => ['nullable', 'string', 'max:180'],
            'current_position' => ['nullable', 'string', 'max:180'],
            'latest_education' => ['nullable', 'string', 'max:180'],
            'nip' => ['nullable', 'string', 'max:50'],
            'birth_place' => ['nullable', 'string', 'max:120'],
            'birth_date' => ['nullable', 'date'],
            'short_profile' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'missions_input' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }

    private function makeUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        if ($base === '') {
            $base = 'calon-rektor';
        }

        $slug = $base;
        $suffix = 2;

        while (
            RectorCandidate::query()
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base . '-' . $suffix;
            $suffix++;
        }

        return $slug;
    }

    private function storePhoto(UploadedFile $file): string
    {
        $directory = public_path('uploads/candidates');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = 'candidate-' . now()->format('YmdHis') . '-' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return 'uploads/candidates/' . $filename;
    }

    /**
     * @return array<int, array<string, string>>
     */
    private function parseMissions(?string $input): array
    {
        if (!is_string($input) || trim($input) === '') {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', $input) ?: [];
        $missions = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            $parts = array_map('trim', explode('|', $line, 2));
            if (count($parts) === 2 && $parts[0] !== '') {
                $missions[] = [
                    'title' => $parts[0],
                    'description' => $parts[1],
                ];
            } else {
                $missions[] = [
                    'title' => 'Misi',
                    'description' => $line,
                ];
            }
        }

        return $missions;
    }

    /**
     * @param  array<int, array<string, mixed>>  $missions
     */
    private function missionsToTextarea(array $missions): string
    {
        $rows = [];

        foreach ($missions as $mission) {
            $title = trim((string) ($mission['title'] ?? ''));
            $description = trim((string) ($mission['description'] ?? ''));

            if ($title === '' && $description === '') {
                continue;
            }

            if ($title === '') {
                $rows[] = $description;
                continue;
            }

            $rows[] = $title . ' | ' . $description;
        }

        return implode(PHP_EOL, $rows);
    }

    private function normalizeOrder(): void
    {
        $items = RectorCandidate::query()->ordered()->get();

        foreach ($items as $index => $item) {
            $newOrder = $index + 1;
            if ($item->candidate_order !== $newOrder) {
                $item->update(['candidate_order' => $newOrder]);
            }
        }
    }
}
