<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\AdminActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:180'],
            'role' => ['nullable', Rule::in(['all', User::ROLE_SUPER_ADMIN, User::ROLE_EDITOR])],
        ]);

        $query = User::query()
            ->when(
                !empty($filters['q']),
                function ($builder) use ($filters): void {
                    $term = trim((string) $filters['q']);
                    $builder->where(function ($inner) use ($term): void {
                        $inner->where('name', 'like', '%' . $term . '%')
                            ->orWhere('email', 'like', '%' . $term . '%');
                    });
                }
            )
            ->when(
                ($filters['role'] ?? 'all') !== 'all',
                fn ($builder) => $builder->where('role', $filters['role'])
            );

        return view('pages.admin.users.index', [
            'users' => $query->orderByDesc('id')->paginate(10)->withQueryString(),
            'roleOptions' => $this->roleOptions(),
            'filters' => [
                'q' => $filters['q'] ?? '',
                'role' => $filters['role'] ?? 'all',
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_EDITOR])],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create($data);

        AdminActivityLogger::log(
            'user.create',
            'Menambahkan user admin baru.',
            $user,
            ['email' => $user->email, 'role' => $user->role],
            $request
        );

        return redirect()->route('admin.users')->with('status', 'User admin berhasil ditambahkan.');
    }

    public function edit(User $user): View
    {
        return view('pages.admin.users.edit', [
            'userItem' => $user,
            'roleOptions' => $this->roleOptions(),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_EDITOR])],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (
            $user->role === User::ROLE_SUPER_ADMIN
            && $data['role'] !== User::ROLE_SUPER_ADMIN
            && User::query()->where('role', User::ROLE_SUPER_ADMIN)->count() <= 1
        ) {
            return redirect()->route('admin.users')
                ->with('error', 'Tidak bisa menurunkan role super admin terakhir.');
        }

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        AdminActivityLogger::log(
            'user.update',
            'Memperbarui user admin.',
            $user,
            ['email' => $user->email, 'role' => $user->role],
            $request
        );

        return redirect()->route('admin.users')->with('status', 'User admin berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $currentUser = $request->user();

        if ($currentUser && $currentUser->id === $user->id) {
            return redirect()->route('admin.users')
                ->with('error', 'Akun yang sedang digunakan tidak bisa dihapus.');
        }

        if (
            $user->role === User::ROLE_SUPER_ADMIN
            && User::query()->where('role', User::ROLE_SUPER_ADMIN)->count() <= 1
        ) {
            return redirect()->route('admin.users')
                ->with('error', 'Super admin terakhir tidak bisa dihapus.');
        }

        $user->delete();

        AdminActivityLogger::log(
            'user.delete',
            'Menghapus user admin.',
            null,
            ['email' => $user->email, 'role' => $user->role],
            $request
        );

        return redirect()->route('admin.users')->with('status', 'User admin berhasil dihapus.');
    }

    /**
     * @return array<string, string>
     */
    private function roleOptions(): array
    {
        return [
            User::ROLE_SUPER_ADMIN => 'Super Admin',
            User::ROLE_EDITOR => 'Editor',
        ];
    }
}
