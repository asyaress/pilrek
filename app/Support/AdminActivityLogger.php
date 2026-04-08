<?php

namespace App\Support;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Throwable;

class AdminActivityLogger
{
    /**
     * @param  mixed  $subject
     * @param  array<string, mixed>  $properties
     */
    public static function log(string $action, string $description, $subject = null, array $properties = [], ?Request $request = null): void
    {
        try {
            if (!Schema::hasTable('activity_logs')) {
                return;
            }

            $request = $request ?: request();
            $user = auth()->user();

            $subjectType = null;
            $subjectId = null;

            if (is_object($subject)) {
                $subjectType = get_class($subject);
                if (method_exists($subject, 'getKey')) {
                    $subjectId = $subject->getKey();
                }
            }

            ActivityLog::query()->create([
                'admin_user_id' => $user?->id,
                'action' => $action,
                'subject_type' => $subjectType,
                'subject_id' => $subjectId,
                'description' => $description,
                'properties' => empty($properties) ? null : $properties,
                'ip_address' => $request?->ip(),
                'user_agent' => $request?->userAgent(),
                'created_at' => now(),
            ]);
        } catch (Throwable) {
            // Ignore logging failures to avoid breaking business flow.
        }
    }
}
