<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\RectorCandidate;
use App\Models\RectorRequirement;
use App\Models\TimelineStage;
use App\Support\HtmlSanitizer;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $timelineItems = $this->timelineItems();
        $candidates = $this->candidateItems(RectorCandidate::STATUS_CALON);
        $news = $this->newsItems();
        $requirements = $this->requirementItems();

        return view('index', [
            'timelineItems' => $timelineItems,
            'homeTimelineItems' => array_slice($timelineItems, 0, 5),
            'homeCandidates' => $candidates->take(4)->values()->all(),
            'homeNewsItems' => $news->take(3)->values()->all(),
            'homeRequirementItems' => $requirements->take(5)->values()->all(),
        ]);
    }

    public function timeline(): View
    {
        return view('pages.timeline', [
            'timelineItems' => $this->timelineItems(),
        ]);
    }

    public function candidates(): View
    {
        return $this->candidateListPage(RectorCandidate::STATUS_CALON);
    }

    public function prospectiveCandidates(): View
    {
        return $this->candidateListPage(RectorCandidate::STATUS_BALON);
    }

    public function requirements(): View
    {
        return view('pages.persyaratan-calon-rektor', [
            'requirementItems' => $this->requirementItems()->values()->all(),
        ]);
    }

    public function candidateDetail(string $slug): View
    {
        return $this->candidateDetailPage(RectorCandidate::STATUS_CALON, $slug);
    }

    public function prospectiveCandidateDetail(string $slug): View
    {
        return $this->candidateDetailPage(RectorCandidate::STATUS_BALON, $slug);
    }

    private function candidateListPage(string $status): View
    {
        return view('pages.calon-rektor', [
            'candidates' => $this->candidateItems($status),
            'pageMeta' => $this->candidatePageMeta($status),
        ]);
    }

    private function candidateDetailPage(string $status, string $slug): View
    {
        $candidate = $this->candidateItems($status)->firstWhere('slug', $slug);

        abort_if(!$candidate, 404);

        return view('pages.detail-calon-rektor', [
            'candidate' => $candidate,
            'pageMeta' => $this->candidatePageMeta($status),
        ]);
    }

    public function news(): View
    {
        $newsItems = $this->newsItems();

        return view('pages.berita', [
            'posts' => $this->paginateCollection($newsItems, 6),
        ]);
    }

    public function newsDetail(string $slug): View
    {
        return $this->publication($slug);
    }

    public function publication(?string $slug = null): View
    {
        $newsItems = $this->newsItems();

        abort_if($newsItems->isEmpty(), 404);

        $post = $slug ? $newsItems->firstWhere('slug', $slug) : $newsItems->first();
        abort_if(!$post, 404);

        $currentIndex = $newsItems->search(static fn (array $item): bool => $item['slug'] === $post['slug']);
        $nextPost = $newsItems->get(($currentIndex === false ? 0 : $currentIndex + 1)) ?: $newsItems->first();

        return view('pages.publikasi', [
            'post' => $post,
            'nextPost' => $nextPost,
        ]);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function timelineItems(): array
    {
        $items = [];

        if (Schema::hasTable('timeline_stages')) {
            $items = TimelineStage::query()
                ->active()
                ->ordered()
                ->get([
                    'date_label',
                    'title',
                    'description',
                    'status',
                ])
                ->map(function (TimelineStage $item): array {
                    return [
                        'date' => $item->date_label,
                        'title' => $item->title,
                        'description' => $item->description,
                        'status' => $item->status,
                    ];
                })
                ->values()
                ->all();
        }

        if (empty($items)) {
            $items = array_map(static function (array $item): array {
                return [
                    'date' => $item['date_label'],
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'status' => $item['status'],
                ];
            }, TimelineStage::defaultSeedData());
        }

        return $items;
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    private function candidateItems(?string $status = null): Collection
    {
        $items = collect();
        $statusFilter = $status === RectorCandidate::STATUS_BALON
            ? [RectorCandidate::STATUS_BALON, RectorCandidate::STATUS_CALON]
            : ($status ? [$status] : []);
        $hasCandidateTable = Schema::hasTable('rector_candidates');

        if ($hasCandidateTable) {
            $hasStatusColumn = Schema::hasColumn('rector_candidates', 'status');
            $items = RectorCandidate::query()
                ->active()
                ->when(
                    !empty($statusFilter) && $hasStatusColumn,
                    fn ($query) => $query->whereIn('status', $statusFilter)
                )
                ->ordered()
                ->get([
                    'candidate_order',
                    ...($hasStatusColumn ? ['status'] : []),
                    'name',
                    'slug',
                    'role_summary',
                    'faculty_unit',
                    'study_program',
                    'academic_position',
                    'current_position',
                    'latest_education',
                    'nip',
                    'birth_place',
                    'birth_date',
                    'short_profile',
                    'vision',
                    'missions',
                    'photo_path',
                ])
                ->map(function (RectorCandidate $item): array {
                    return [
                        'order' => (int) $item->candidate_order,
                        'status' => ($item->status ?: RectorCandidate::STATUS_CALON),
                        'name' => $item->name,
                        'slug' => $item->slug,
                        'role_summary' => $item->role_summary,
                        'faculty_unit' => $item->faculty_unit,
                        'study_program' => $item->study_program,
                        'academic_position' => $item->academic_position,
                        'current_position' => $item->current_position,
                        'latest_education' => $item->latest_education,
                        'nip' => $item->nip,
                        'birth_place' => $item->birth_place,
                        'birth_date' => $item->birth_date?->format('Y-m-d'),
                        'short_profile' => $item->short_profile,
                        'vision' => $item->vision,
                        'missions' => is_array($item->missions) ? $item->missions : [],
                        'photo_url' => $item->photo_path ? asset($item->photo_path) : asset('template/img/inner-pages/team/1.png'),
                    ];
                })
                ->when(
                    $status && !$hasStatusColumn,
                    fn (Collection $collection) => in_array(RectorCandidate::STATUS_CALON, $statusFilter, true) ? $collection : collect()
                )
                ->values();
        }

        if (!$hasCandidateTable && $items->isEmpty()) {
            $items = collect(RectorCandidate::defaultSeedData())
                ->when(
                    !empty($statusFilter),
                    fn (Collection $collection) => $collection->whereIn('status', $statusFilter)
                )
                ->map(function (array $item): array {
                    return [
                        'order' => (int) ($item['candidate_order'] ?? 0),
                        'status' => $item['status'] ?? RectorCandidate::STATUS_CALON,
                        'name' => $item['name'],
                        'slug' => $item['slug'] ?? Str::slug((string) ($item['name'] ?? 'calon-rektor')),
                        'role_summary' => $item['role_summary'] ?? null,
                        'faculty_unit' => $item['faculty_unit'] ?? null,
                        'study_program' => $item['study_program'] ?? null,
                        'academic_position' => $item['academic_position'] ?? null,
                        'current_position' => $item['current_position'] ?? null,
                        'latest_education' => $item['latest_education'] ?? null,
                        'nip' => $item['nip'] ?? null,
                        'birth_place' => $item['birth_place'] ?? null,
                        'birth_date' => $item['birth_date'] ?? null,
                        'short_profile' => $item['short_profile'] ?? null,
                        'vision' => $item['vision'] ?? null,
                        'missions' => is_array($item['missions'] ?? null) ? $item['missions'] : [],
                        'photo_url' => asset($item['photo_path'] ?? 'template/img/inner-pages/team/1.png'),
                    ];
                })
                ->values();
        }

        return $items;
    }

    /**
     * @return array<string, string>
     */
    private function candidatePageMeta(string $status): array
    {
        $isBalon = $status === RectorCandidate::STATUS_BALON;

        return [
            'status' => $status,
            'activePage' => $isBalon ? 'balon' : 'calon-rektor',
            'title' => $isBalon ? 'Balon Rektor' : 'Calon Rektor',
            'kicker' => 'Pemilihan Rektor 2026',
            'description' => $isBalon
                ? 'Daftar bakal calon rektor Pemilihan Rektor Universitas Periode 2026-2030'
                : 'Daftar calon rektor Pemilihan Rektor Universitas Periode 2026-2030',
            'empty' => $isBalon
                ? 'Data bakal calon rektor belum tersedia.'
                : 'Data calon rektor belum tersedia.',
            'detailKicker' => $isBalon ? 'Balon Rektor' : 'Calon Rektor',
            'profileKicker' => $isBalon ? 'Profil Balon' : 'Profil Calon',
            'shortProfileFallback' => $isBalon
                ? 'Profil singkat balon belum tersedia.'
                : 'Profil singkat calon belum tersedia.',
            'visionFallback' => $isBalon
                ? 'Visi balon belum tersedia.'
                : 'Visi calon belum tersedia.',
            'missionsFallback' => $isBalon
                ? 'Data misi balon belum tersedia.'
                : 'Data misi calon belum tersedia.',
            'indexRoute' => $isBalon ? 'balon' : 'calon-rektor',
            'detailRoute' => $isBalon ? 'balon.detail' : 'calon-rektor.detail',
        ];
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    private function newsItems(): Collection
    {
        $items = collect();

        if (Schema::hasTable('news_posts')) {
            $items = NewsPost::query()
                ->published()
                ->ordered()
                ->get([
                    'title',
                    'slug',
                    'excerpt',
                    'content',
                    'cover_image_path',
                    'tags',
                    'published_at',
                ])
                ->map(function (NewsPost $item): array {
                    return [
                        'title' => $item->title,
                        'slug' => $item->slug,
                        'excerpt' => HtmlSanitizer::sanitizePlainText($item->excerpt, 1000),
                        'content' => HtmlSanitizer::sanitizeArticle($item->content),
                        'cover_url' => $item->cover_image_path ? asset($item->cover_image_path) : asset('template/img/inner-pages/blog/1.png'),
                        'tags' => is_array($item->tags) ? $item->tags : [],
                        'published_at' => $item->published_at?->format('Y-m-d H:i:s'),
                        'published_label' => $item->published_at?->translatedFormat('d F Y') ?? '-',
                    ];
                })
                ->values();
        }

        if ($items->isEmpty()) {
            $items = collect(NewsPost::defaultSeedData())
                ->map(function (array $item): array {
                    $publishedAt = !empty($item['published_at']) ? Carbon::parse($item['published_at']) : null;

                    return [
                        'title' => $item['title'],
                        'slug' => $item['slug'] ?? Str::slug((string) ($item['title'] ?? 'berita')),
                        'excerpt' => HtmlSanitizer::sanitizePlainText($item['excerpt'] ?? null, 1000),
                        'content' => HtmlSanitizer::sanitizeArticle($item['content'] ?? null),
                        'cover_url' => asset($item['cover_image_path'] ?? 'template/img/inner-pages/blog/1.png'),
                        'tags' => is_array($item['tags'] ?? null) ? $item['tags'] : [],
                        'published_at' => $publishedAt?->format('Y-m-d H:i:s'),
                        'published_label' => $publishedAt?->translatedFormat('d F Y') ?? '-',
                    ];
                })
                ->values();
        }

        return $items;
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    private function requirementItems(): Collection
    {
        $items = collect();

        if (Schema::hasTable('rector_requirements')) {
            $items = RectorRequirement::query()
                ->active()
                ->ordered()
                ->get([
                    'requirement_order',
                    'label',
                    'title',
                    'description',
                    'details',
                    'tab_color',
                    'gradient_start',
                    'gradient_middle',
                    'gradient_end',
                ])
                ->map(function (RectorRequirement $item): array {
                    return [
                        'order' => (int) $item->requirement_order,
                        'label' => $item->label,
                        'title' => $item->title,
                        'description' => $item->description,
                        'details' => is_array($item->details) ? $item->details : [],
                        'tab_color' => $item->tab_color ?: '#36b6a5',
                        'gradient_start' => $item->gradient_start ?: '#299a8d',
                        'gradient_middle' => $item->gradient_middle ?: '#36b6a5',
                        'gradient_end' => $item->gradient_end ?: '#268d83',
                    ];
                })
                ->values();
        }

        if ($items->isEmpty()) {
            $items = collect(RectorRequirement::defaultSeedData())
                ->map(function (array $item): array {
                    return [
                        'order' => (int) ($item['requirement_order'] ?? 0),
                        'label' => $item['label'] ?? 'Persyaratan',
                        'title' => $item['title'] ?? 'Persyaratan',
                        'description' => $item['description'] ?? '-',
                        'details' => is_array($item['details'] ?? null) ? $item['details'] : [],
                        'tab_color' => $item['tab_color'] ?? '#36b6a5',
                        'gradient_start' => $item['gradient_start'] ?? '#299a8d',
                        'gradient_middle' => $item['gradient_middle'] ?? '#36b6a5',
                        'gradient_end' => $item['gradient_end'] ?? '#268d83',
                    ];
                })
                ->values();
        }

        return $items;
    }

    private function paginateCollection(Collection $items, int $perPage): LengthAwarePaginator
    {
        $currentPage = max(1, request()->integer('page', 1));
        $currentItems = $items->slice(($currentPage - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $currentItems,
            $items->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }
}
