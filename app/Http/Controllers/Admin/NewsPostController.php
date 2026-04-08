<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use App\Support\AdminActivityLogger;
use App\Support\HtmlSanitizer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsPostController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:180'],
            'status' => ['nullable', 'in:all,draft,published'],
            'featured' => ['nullable', 'in:all,1,0'],
        ]);

        $query = NewsPost::query()
            ->when(
                !empty($filters['q']),
                function ($builder) use ($filters): void {
                    $term = trim((string) $filters['q']);
                    $builder->where(function ($inner) use ($term): void {
                        $inner->where('title', 'like', '%' . $term . '%')
                            ->orWhere('excerpt', 'like', '%' . $term . '%')
                            ->orWhere('content', 'like', '%' . $term . '%');
                    });
                }
            )
            ->when(
                ($filters['status'] ?? 'all') !== 'all',
                fn ($builder) => $builder->where('status', $filters['status'])
            )
            ->when(
                ($filters['featured'] ?? 'all') !== 'all',
                fn ($builder) => $builder->where('is_featured', $filters['featured'] === '1')
            );

        return view('pages.admin.news.index', [
            'posts' => $query->ordered()->paginate(10)->withQueryString(),
            'statusOptions' => $this->statusOptions(),
            'filters' => [
                'q' => $filters['q'] ?? '',
                'status' => $filters['status'] ?? 'all',
                'featured' => $filters['featured'] ?? 'all',
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data = $this->sanitizeContentPayload($data);
        $data['slug'] = $this->makeUniqueSlug($data['title']);
        $data['tags'] = $this->parseTags($request->input('tags_input'));
        $data['is_featured'] = $request->boolean('is_featured');

        if ($data['status'] === NewsPost::STATUS_PUBLISHED && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $this->storeNewsImage($request->file('cover_image'), 'news');
        }

        unset($data['cover_image'], $data['tags_input']);

        $post = NewsPost::create($data);

        AdminActivityLogger::log(
            'news.create',
            'Menambahkan berita baru.',
            $post,
            ['title' => $post->title, 'status' => $post->status],
            $request
        );

        return redirect()->route('admin.news.index')
            ->with('status', 'Berita berhasil ditambahkan.');
    }

    public function edit(NewsPost $news): View
    {
        $news->excerpt = HtmlSanitizer::sanitizePlainText($news->excerpt, 1000);
        $news->content = HtmlSanitizer::sanitizeArticle($news->content);

        return view('pages.admin.news.edit', [
            'post' => $news,
            'statusOptions' => $this->statusOptions(),
            'tagsInput' => implode(', ', $news->tags ?? []),
        ]);
    }

    public function update(Request $request, NewsPost $news): RedirectResponse
    {
        $data = $this->validateData($request);
        $data = $this->sanitizeContentPayload($data);
        $data['slug'] = $this->makeUniqueSlug($data['title'], $news->id);
        $data['tags'] = $this->parseTags($request->input('tags_input'));
        $data['is_featured'] = $request->boolean('is_featured');

        if ($data['status'] === NewsPost::STATUS_PUBLISHED && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($data['status'] === NewsPost::STATUS_DRAFT) {
            $data['published_at'] = null;
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $this->storeNewsImage($request->file('cover_image'), 'news');
        }

        unset($data['cover_image'], $data['tags_input']);

        $news->update($data);

        AdminActivityLogger::log(
            'news.update',
            'Memperbarui berita.',
            $news,
            ['title' => $news->title, 'status' => $news->status],
            $request
        );

        return redirect()->route('admin.news.index')
            ->with('status', 'Berita berhasil diperbarui.');
    }

    public function destroy(Request $request, NewsPost $news): RedirectResponse
    {
        $snapshot = [
            'title' => $news->title,
            'status' => $news->status,
        ];

        $news->delete();

        AdminActivityLogger::log(
            'news.delete',
            'Menghapus berita.',
            null,
            $snapshot,
            $request
        );

        return redirect()->route('admin.news.index')
            ->with('status', 'Berita berhasil dihapus.');
    }

    public function uploadEditorImage(Request $request): JsonResponse
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        /** @var UploadedFile $image */
        $image = $data['image'];
        $path = $this->storeNewsImage($image, 'news-media');

        AdminActivityLogger::log(
            'news.media.upload',
            'Upload gambar dari editor berita.',
            null,
            ['path' => $path],
            $request
        );

        return response()->json([
            'url' => asset($path),
            'path' => $path,
            'name' => basename($path),
        ]);
    }

    public function mediaLibrary(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('q', ''));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $files = collect(Storage::disk('public')->files('news'))
            ->filter(static function (string $path) use ($allowedExtensions): bool {
                $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

                return in_array($extension, $allowedExtensions, true);
            })
            ->when(
                $search !== '',
                static function ($collection) use ($search) {
                    return $collection->filter(static function (string $path) use ($search): bool {
                        return str_contains(strtolower(basename($path)), strtolower($search));
                    });
                }
            )
            ->sortByDesc(static fn (string $path): int => Storage::disk('public')->lastModified($path))
            ->take(80)
            ->values()
            ->map(static function (string $path): array {
                $relativePath = 'storage/' . ltrim($path, '/');

                return [
                    'name' => basename($path),
                    'url' => asset($relativePath),
                    'path' => $relativePath,
                    'size_kb' => round(Storage::disk('public')->size($path) / 1024, 1),
                    'modified_at' => date('Y-m-d H:i:s', Storage::disk('public')->lastModified($path)),
                ];
            })
            ->all();

        return response()->json([
            'items' => $files,
        ]);
    }

    /**
     * @return array<string, string>
     */
    private function statusOptions(): array
    {
        return [
            NewsPost::STATUS_DRAFT => 'Draft',
            NewsPost::STATUS_PUBLISHED => 'Published',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:220'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'tags_input' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);
    }

    /**
     * @return array<int, string>
     */
    private function parseTags(?string $input): array
    {
        if (!is_string($input) || trim($input) === '') {
            return [];
        }

        $parts = array_map('trim', explode(',', $input));
        $parts = array_filter($parts, static fn (string $part): bool => $part !== '');

        return array_values(array_unique($parts));
    }

    private function makeUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        if ($base === '') {
            $base = 'berita';
        }

        $slug = $base;
        $suffix = 2;

        while (
            NewsPost::query()
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base . '-' . $suffix;
            $suffix++;
        }

        return $slug;
    }

    private function storeNewsImage(UploadedFile $file, string $prefix): string
    {
        $filename = $prefix . '-' . now()->format('YmdHis') . '-' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $storedPath = $file->storeAs('news', $filename, 'public');
        if ($storedPath === false) {
            return '';
        }

        return 'storage/' . $storedPath;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function sanitizeContentPayload(array $data): array
    {
        $sanitizedTitle = HtmlSanitizer::sanitizePlainText((string) ($data['title'] ?? ''), 220);
        $data['title'] = $sanitizedTitle !== null ? $sanitizedTitle : trim((string) ($data['title'] ?? ''));

        $data['excerpt'] = HtmlSanitizer::sanitizePlainText($data['excerpt'] ?? null, 1000);

        $sanitizedContent = HtmlSanitizer::sanitizeArticle($data['content'] ?? null);
        $data['content'] = $sanitizedContent !== '' ? $sanitizedContent : null;

        return $data;
    }
}
