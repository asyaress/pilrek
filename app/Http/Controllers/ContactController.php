<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Support\AdminActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store contact form submission.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'tel' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:5000'],
            'checkmark' => ['accepted'],
        ], [
            'checkmark.accepted' => 'Persetujuan pengolahan data wajib dicentang.',
        ]);

        $message = ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['tel'] ?? null,
            'message' => $data['message'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        AdminActivityLogger::log(
            'contact.submit',
            'Pesan kontak baru dikirim dari website publik.',
            $message,
            ['email' => $message->email],
            $request
        );

        return redirect()->route('kontak')
            ->with('status', 'Pesan Anda berhasil dikirim. Terima kasih.');
    }
}
