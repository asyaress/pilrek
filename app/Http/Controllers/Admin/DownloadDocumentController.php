<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DownloadDocument;
use App\Support\AdminActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DownloadDocumentController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:180'],
            'active' => ['nullable', 'in:all,1,0'],
        ]);

        $query = DownloadDocument::query()
            ->when(
                !empty($filters['q']),
                function ($builder) use ($filters): void {
                    $term = trim((string) $filters['q']);
                    $builder->where(function ($inner) use ($term): void {
                        $inner->where('title', 'like', '%' . $term . '%')
                            ->orWhere('description', 'like', '%' . $term . '%')
                            ->orWhere('file_name', 'like', '%' . $term . '%');
                    });
                }
            )
            ->when(
                ($filters['active'] ?? 'all') !== 'all',
                fn ($builder) => $builder->where('is_active', ($filters['active'] ?? 'all') === '1')
            );

        return view('pages.admin.downloads.index', [
            'documents' => $query->ordered()->paginate(10)->withQueryString(),
            'filters' => [
                'q' => $filters['q'] ?? '',
                'active' => $filters['active'] ?? 'all',
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request, false);
        $data['document_order'] = (int) DownloadDocument::query()->max('document_order') + 1;
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('file')) {
            $fileMeta = $this->storeDocumentFile($request->file('file'));
            $data = array_merge($data, $fileMeta);
        }

        unset($data['file']);

        $document = DownloadDocument::create($data);

        AdminActivityLogger::log(
            'download.create',
            'Menambahkan dokumen unduhan.',
            $document,
            ['title' => $document->title, 'order' => $document->document_order],
            $request
        );

        return redirect()->route('admin.downloads.index')
            ->with('status', 'Dokumen unduhan berhasil ditambahkan.');
    }

    public function edit(DownloadDocument $download): View
    {
        return view('pages.admin.downloads.edit', [
            'document' => $download,
        ]);
    }

    public function update(Request $request, DownloadDocument $download): RedirectResponse
    {
        $data = $this->validateData($request, true);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('file')) {
            $this->deleteStoredFile($download->file_path);
            $data = array_merge($data, $this->storeDocumentFile($request->file('file')));
        } elseif ($request->boolean('remove_file')) {
            $this->deleteStoredFile($download->file_path);
            $data['file_path'] = null;
            $data['file_name'] = null;
            $data['file_extension'] = null;
            $data['file_size_kb'] = null;
        }

        unset($data['file'], $data['remove_file']);

        $download->update($data);

        AdminActivityLogger::log(
            'download.update',
            'Memperbarui dokumen unduhan.',
            $download,
            ['title' => $download->title, 'order' => $download->document_order],
            $request
        );

        return redirect()->route('admin.downloads.index')
            ->with('status', 'Dokumen unduhan berhasil diperbarui.');
    }

    public function destroy(Request $request, DownloadDocument $download): RedirectResponse
    {
        $snapshot = [
            'title' => $download->title,
            'order' => $download->document_order,
        ];

        $this->deleteStoredFile($download->file_path);
        $download->delete();
        $this->normalizeOrder();

        AdminActivityLogger::log(
            'download.delete',
            'Menghapus dokumen unduhan.',
            null,
            $snapshot,
            $request
        );

        return redirect()->route('admin.downloads.index')
            ->with('status', 'Dokumen unduhan berhasil dihapus.');
    }

    public function move(Request $request, DownloadDocument $download): RedirectResponse
    {
        $direction = $request->validate([
            'direction' => ['required', 'in:up,down'],
        ])['direction'];

        $swapWith = DownloadDocument::query()
            ->when(
                $direction === 'up',
                fn ($query) => $query->where('document_order', '<', $download->document_order)->orderByDesc('document_order'),
                fn ($query) => $query->where('document_order', '>', $download->document_order)->orderBy('document_order')
            )
            ->first();

        if ($swapWith) {
            $currentOrder = $download->document_order;
            $download->update(['document_order' => $swapWith->document_order]);
            $swapWith->update(['document_order' => $currentOrder]);

            AdminActivityLogger::log(
                'download.reorder',
                'Mengubah urutan dokumen unduhan.',
                $download,
                [
                    'direction' => $direction,
                    'from_order' => $currentOrder,
                    'to_order' => $download->document_order,
                ],
                $request
            );
        }

        return redirect()->back();
    }

    /**
     * @return array<string, mixed>
     */
    private function validateData(Request $request, bool $isUpdate): array
    {
        $fileRules = ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'];
        if (!$isUpdate) {
            $fileRules = ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'];
        }

        return $request->validate([
            'title' => ['required', 'string', 'max:220'],
            'description' => ['nullable', 'string'],
            'file' => $fileRules,
            'remove_file' => ['nullable', 'boolean'],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function storeDocumentFile(UploadedFile $file): array
    {
        $extension = strtolower((string) $file->getClientOriginalExtension());
        $filename = 'dokumen-' . now()->format('YmdHis') . '-' . Str::random(6) . '.' . $extension;
        $storedPath = $file->storeAs('downloads', $filename, 'public');

        if ($storedPath === false) {
            return [];
        }

        return [
            'file_path' => 'storage/' . $storedPath,
            'file_name' => $file->getClientOriginalName(),
            'file_extension' => $extension,
            'file_size_kb' => (int) ceil($file->getSize() / 1024),
        ];
    }

    private function deleteStoredFile(?string $filePath): void
    {
        if (!is_string($filePath) || $filePath === '') {
            return;
        }

        if (!str_starts_with($filePath, 'storage/')) {
            return;
        }

        $relativePath = ltrim(substr($filePath, strlen('storage/')), '/');

        if ($relativePath === '' || !str_starts_with($relativePath, 'downloads/')) {
            return;
        }

        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }

    private function normalizeOrder(): void
    {
        $items = DownloadDocument::query()->ordered()->get();

        foreach ($items as $index => $item) {
            $newOrder = $index + 1;
            if ($item->document_order !== $newOrder) {
                $item->update(['document_order' => $newOrder]);
            }
        }
    }
}

