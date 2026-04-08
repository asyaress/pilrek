<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            return redirect()->guest(route('admin.login'))
                ->with('error', 'Silakan login terlebih dahulu untuk mengakses admin.');
        }

        $user = $request->user();
        if (!$user || !$user->hasAnyRole([User::ROLE_SUPER_ADMIN, User::ROLE_EDITOR])) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->guest(route('admin.login'))
                ->with('error', 'Akun Anda tidak memiliki akses ke panel admin.');
        }

        return $next($request);
    }
}
