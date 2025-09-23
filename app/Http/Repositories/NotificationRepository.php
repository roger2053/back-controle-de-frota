<?php

namespace App\Http\Repositories;

use App\Models\Notification;
use App\Models\Stock;
use App\Models\StockAdd;
use App\Models\StockWithdrawn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationRepository
{

    private $notification;
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function getAll()
    {
        $query = $this->notification->select(
            'title',
            'body',
            'is_alert',
            'was_read',
            DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') as created_at_formatted")
        );
        $query->where('user_id', Auth::id());
        $query->orderByDesc('id');
        return $query->get();
    }

    public function updateAll()
    {
        return $this->notification
            ->where('user_id', Auth::id())
            ->where('was_read', 0)
            ->update(['was_read' => 1]);
    }
}
