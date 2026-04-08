<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimelineStage;
use App\Support\AdminActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TimelineStageController extends Controller
{
    /**
     * Show list timeline.
     */
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:180'],
            'status' => ['nullable', 'in:all,upcoming,ongoing,done'],
            'active' => ['nullable', 'in:all,1,0'],
        ]);

        $query = TimelineStage::query()
            ->when(
                !empty($filters['q']),
                function ($builder) use ($filters): void {
                    $term = trim((string) $filters['q']);
                    $builder->where(function ($inner) use ($term): void {
                        $inner->where('title', 'like', '%' . $term . '%')
                            ->orWhere('description', 'like', '%' . $term . '%')
                            ->orWhere('date_label', 'like', '%' . $term . '%');
                    });
                }
            )
            ->when(
                ($filters['status'] ?? 'all') !== 'all',
                fn ($builder) => $builder->where('status', $filters['status'])
            )
            ->when(
                ($filters['active'] ?? 'all') !== 'all',
                fn ($builder) => $builder->where('is_active', $filters['active'] === '1')
            );

        return view('pages.admin.timeline.index', [
            'timelineStages' => $query->ordered()->paginate(10)->withQueryString(),
            'statusOptions' => $this->statusOptions(),
            'filters' => [
                'q' => $filters['q'] ?? '',
                'status' => $filters['status'] ?? 'all',
                'active' => $filters['active'] ?? 'all',
            ],
        ]);
    }

    /**
     * Store new timeline stage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['stage_order'] = (int) TimelineStage::query()->max('stage_order') + 1;
        $data['is_active'] = $request->boolean('is_active');

        $stage = TimelineStage::create($data);

        AdminActivityLogger::log(
            'timeline.create',
            'Menambahkan tahap timeline baru.',
            $stage,
            ['title' => $stage->title, 'order' => $stage->stage_order],
            $request
        );

        return redirect()->route('admin.timeline.index')
            ->with('status', 'Tahap timeline berhasil ditambahkan.');
    }

    /**
     * Show edit form.
     */
    public function edit(TimelineStage $timelineStage): View
    {
        return view('pages.admin.timeline.edit', [
            'timelineStage' => $timelineStage,
            'statusOptions' => $this->statusOptions(),
        ]);
    }

    /**
     * Update timeline stage.
     */
    public function update(Request $request, TimelineStage $timelineStage): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['is_active'] = $request->boolean('is_active');

        $timelineStage->update($data);

        AdminActivityLogger::log(
            'timeline.update',
            'Memperbarui tahap timeline.',
            $timelineStage,
            ['title' => $timelineStage->title, 'order' => $timelineStage->stage_order],
            $request
        );

        return redirect()->route('admin.timeline.index')
            ->with('status', 'Tahap timeline berhasil diperbarui.');
    }

    /**
     * Delete timeline stage.
     */
    public function destroy(Request $request, TimelineStage $timelineStage): RedirectResponse
    {
        $snapshot = [
            'title' => $timelineStage->title,
            'order' => $timelineStage->stage_order,
        ];

        $timelineStage->delete();
        $this->normalizeOrder();

        AdminActivityLogger::log(
            'timeline.delete',
            'Menghapus tahap timeline.',
            null,
            $snapshot,
            $request
        );

        return redirect()->route('admin.timeline.index')
            ->with('status', 'Tahap timeline berhasil dihapus.');
    }

    /**
     * Move stage up/down in order.
     */
    public function move(Request $request, TimelineStage $timelineStage): RedirectResponse
    {
        $direction = $request->validate([
            'direction' => ['required', 'in:up,down'],
        ])['direction'];

        $swapWith = TimelineStage::query()
            ->when(
                $direction === 'up',
                fn ($query) => $query->where('stage_order', '<', $timelineStage->stage_order)->orderByDesc('stage_order'),
                fn ($query) => $query->where('stage_order', '>', $timelineStage->stage_order)->orderBy('stage_order')
            )
            ->first();

        if ($swapWith) {
            $currentOrder = $timelineStage->stage_order;
            $timelineStage->update(['stage_order' => $swapWith->stage_order]);
            $swapWith->update(['stage_order' => $currentOrder]);

            AdminActivityLogger::log(
                'timeline.reorder',
                'Mengubah urutan tahap timeline.',
                $timelineStage,
                [
                    'direction' => $direction,
                    'from_order' => $currentOrder,
                    'to_order' => $timelineStage->stage_order,
                ],
                $request
            );
        }

        return redirect()->back();
    }

    /**
     * @return array<string, string>
     */
    private function statusOptions(): array
    {
        return [
            TimelineStage::STATUS_UPCOMING => 'Upcoming',
            TimelineStage::STATUS_ONGOING => 'Ongoing',
            TimelineStage::STATUS_DONE => 'Done',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'date_label' => ['required', 'string', 'max:120'],
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:upcoming,ongoing,done'],
        ]);
    }

    private function normalizeOrder(): void
    {
        $stages = TimelineStage::query()->ordered()->get();

        foreach ($stages as $index => $stage) {
            $newOrder = $index + 1;
            if ($stage->stage_order !== $newOrder) {
                $stage->update(['stage_order' => $newOrder]);
            }
        }
    }
}
