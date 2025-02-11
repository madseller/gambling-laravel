<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $userId = $request->input('user_id');
        $message = $request->input('message');

        SendNotification::dispatch($userId, $message);

        return response()->json(['status' => 'queued']);
    }
}
