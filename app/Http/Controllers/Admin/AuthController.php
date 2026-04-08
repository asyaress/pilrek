<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\AdminActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the admin login page.
     */
    public function showLoginForm(): View
    {
        return view('pages.admin.login');
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = $request->user();
            if (!$user || !$user->hasAnyRole([User::ROLE_SUPER_ADMIN, User::ROLE_EDITOR])) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                AdminActivityLogger::log(
                    'auth.login_denied',
                    'Percobaan login ditolak karena role tidak memiliki akses admin.',
                    $user,
                    ['email' => $credentials['email']],
                    $request
                );

                return back()
                    ->withErrors([
                        'email' => 'Akun ini tidak memiliki akses ke panel admin.',
                    ])
                    ->onlyInput('email');
            }

            AdminActivityLogger::log(
                'auth.login',
                'Login admin berhasil.',
                $user,
                ['email' => $user->email],
                $request
            );

            return redirect()->intended(route('admin.dashboard'));
        }

        AdminActivityLogger::log(
            'auth.login_failed',
            'Percobaan login gagal.',
            null,
            ['email' => $credentials['email']],
            $request
        );

        return back()
            ->withErrors([
                'email' => 'Email atau password tidak valid.',
            ])
            ->onlyInput('email');
    }

    /**
     * Logout current admin session.
     */
    public function logout(Request $request): RedirectResponse
    {
        $user = $request->user();

        AdminActivityLogger::log(
            'auth.logout',
            'Logout admin berhasil.',
            $user,
            ['email' => $user?->email],
            $request
        );

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Berhasil logout.');
    }
}
