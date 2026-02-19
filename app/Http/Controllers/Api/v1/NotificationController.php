<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private const PER_PAGE = 20;

    /**
     * List the current user's notifications (paginated). Newest first.
     *
     * @group Notifications
     * @queryParam page integer Page number. Example: 1
     * @queryParam unread_only boolean If true, only return unread. Example: 0
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $query = $user->appNotifications()->orderByDesc('created_at');

        if ($request->boolean('unread_only')) {
            $query->whereNull('read_at');
        }

        $notifications = $query->paginate(self::PER_PAGE);

        return HttpStatusCode::OK->toResponse([
            'data' => $notifications->items(),
            'meta' => [
                'current_page' => $notifications->currentPage(),
                'last_page' => $notifications->lastPage(),
                'per_page' => $notifications->perPage(),
                'total' => $notifications->total(),
                'from' => $notifications->firstItem(),
                'to' => $notifications->lastItem(),
            ],
        ]);
    }

    /**
     * Get a single notification. Returns 404 if not found or not owned by the user.
     *
     * @group Notifications
     * @urlParam notification string required Notification UUID. Example: 9d4e8f2a-1b3c-4d5e-6f7a-8b9c0d1e2f3a
     */
    public function show(Request $request, string $notification)
    {
        $item = $request->user()->appNotifications()->find($notification);

        if (! $item) {
            return HttpStatusCode::NotFound->toResponse([
                'message' => 'Notification not found.',
            ]);
        }

        return HttpStatusCode::OK->toResponse([
            'data' => $item,
        ]);
    }

    /**
     * Mark a notification as read.
     *
     * @group Notifications
     * @urlParam notification string required Notification UUID.
     */
    public function read(Request $request, string $notification)
    {
        $item = $request->user()->appNotifications()->find($notification);

        if (! $item) {
            return HttpStatusCode::NotFound->toResponse([
                'message' => 'Notification not found.',
            ]);
        }

        if ($item->read_at === null) {
            $item->update(['read_at' => now()]);
        }

        return HttpStatusCode::OK->toResponse([
            'message' => 'Notification marked as read.',
            'data' => $item->fresh(),
        ]);
    }

    /**
     * Mark all of the current user's notifications as read.
     *
     * @group Notifications
     */
    public function readAll(Request $request)
    {
        $count = $request->user()->appNotifications()->whereNull('read_at')->update(['read_at' => now()]);

        return HttpStatusCode::OK->toResponse([
            'message' => 'All notifications marked as read.',
            'data' => ['updated_count' => $count],
        ]);
    }

    /**
     * Delete a single notification. Returns 404 if not found or not owned by the user.
     *
     * @group Notifications
     * @urlParam notification string required Notification UUID.
     */
    public function destroy(Request $request, string $notification)
    {
        $item = $request->user()->appNotifications()->find($notification);

        if (! $item) {
            return HttpStatusCode::NotFound->toResponse([
                'message' => 'Notification not found.',
            ]);
        }

        $item->delete();

        return response()->json(null, 204);
    }

    /**
     * Delete all of the current user's notifications.
     *
     * @group Notifications
     */
    public function destroyAll(Request $request)
    {
        $count = $request->user()->appNotifications()->delete();

        return HttpStatusCode::OK->toResponse([
            'message' => 'All notifications deleted.',
            'data' => ['deleted_count' => $count],
        ]);
    }
}
