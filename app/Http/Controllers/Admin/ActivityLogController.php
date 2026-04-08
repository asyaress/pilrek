<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'action' => ['nullable', 'string', 'max:120'],
            'admin_user_id' => ['nullable', 'integer', 'min:1'],
            'q' => ['nullable', 'string', 'max:180'],
            'from_date' => ['nullable', 'date'],
            'to_date' => ['nullable', 'date'],
        ]);

        $logs = ActivityLog::query()
            ->latestFirst()
            ->when(
                !empty($filters['action']),
                fn ($query) => $query->where('action', (string) $filters['action'])
            )
            ->when(
                !empty($filters['admin_user_id']),
                fn ($query) => $query->where('admin_user_id', (int) $filters['admin_user_id'])
            )
            ->when(
                !empty($filters['q']),
                function ($query) use ($filters): void {
                    $term = trim((string) $filters['q']);
                    $query->where(function ($inner) use ($term): void {
                        $inner->where('description', 'like', '%' . $term . '%')
                            ->orWhere('action', 'like', '%' . $term . '%');
                    });
                }
            )
            ->when(
                !empty($filters['from_date']),
                fn ($query) => $query->whereDate('created_at', '>=', $filters['from_date'])
            )
            ->when(
                !empty($filters['to_date']),
                fn ($query) => $query->whereDate('created_at', '<=', $filters['to_date'])
            )
            ->paginate(20)
            ->withQueryString();

        return view('pages.admin.activity.index', [
            'logs' => $logs,
            'actions' => ActivityLog::query()->select('action')->distinct()->orderBy('action')->pluck('action')->all(),
            'adminUsers' => User::query()->orderBy('name')->get(['id', 'name', 'email']),
            'filters' => [
                'action' => $filters['action'] ?? '',
                'admin_user_id' => isset($filters['admin_user_id']) ? (string) $filters['admin_user_id'] : '',
                'q' => $filters['q'] ?? '',
                'from_date' => $filters['from_date'] ?? '',
                'to_date' => $filters['to_date'] ?? '',
            ],
        ]);
    }
}
