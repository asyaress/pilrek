<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Support\AdminActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        $filters = request()->validate([
            'q' => ['nullable', 'string', 'max:180'],
            'status' => ['nullable', 'in:all,read,unread'],
        ]);

        $query = ContactMessage::query()
            ->when(
                !empty($filters['q']),
                function ($builder) use ($filters): void {
                    $term = trim((string) $filters['q']);
                    $builder->where(function ($inner) use ($term): void {
                        $inner->where('name', 'like', '%' . $term . '%')
                            ->orWhere('email', 'like', '%' . $term . '%')
                            ->orWhere('phone', 'like', '%' . $term . '%')
                            ->orWhere('message', 'like', '%' . $term . '%');
                    });
                }
            )
            ->when(
                ($filters['status'] ?? 'all') !== 'all',
                fn ($builder) => $builder->where('is_read', $filters['status'] === 'read')
            );

        return view('pages.admin.messages.index', [
            'messages' => $query->latestFirst()->paginate(15)->withQueryString(),
            'unreadCount' => ContactMessage::query()->unread()->count(),
            'filters' => [
                'q' => $filters['q'] ?? '',
                'status' => $filters['status'] ?? 'all',
            ],
        ]);
    }

    public function show(ContactMessage $message): View
    {
        if (!$message->is_read) {
            $message->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

            AdminActivityLogger::log(
                'message.read',
                'Membuka pesan kontak dan menandainya sebagai terbaca.',
                $message,
                ['email' => $message->email],
                request()
            );
        }

        return view('pages.admin.messages.show', [
            'messageItem' => $message->fresh(),
        ]);
    }

    public function markAsRead(ContactMessage $message): RedirectResponse
    {
        if (!$message->is_read) {
            $message->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

            AdminActivityLogger::log(
                'message.read',
                'Menandai pesan kontak sebagai terbaca.',
                $message,
                ['email' => $message->email],
                request()
            );
        }

        return redirect()->route('admin.messages.index')
            ->with('status', 'Pesan ditandai sebagai terbaca.');
    }

    public function destroy(Request $request, ContactMessage $message): RedirectResponse
    {
        $snapshot = [
            'name' => $message->name,
            'email' => $message->email,
        ];

        $message->delete();

        AdminActivityLogger::log(
            'message.delete',
            'Menghapus pesan kontak.',
            null,
            $snapshot,
            $request
        );

        return redirect()->route('admin.messages.index')
            ->with('status', 'Pesan berhasil dihapus.');
    }
}
