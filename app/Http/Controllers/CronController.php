<?php

namespace App\Http\Controllers;

use App\Services\ExpiryNotificationService;

class CronController extends Controller
{
    public function sendExpiryNotifications(ExpiryNotificationService $service)
    {
        $customerList = $service->process();

        return response()->json([
            'message' => 'Expiry notification job executed successfully.',
            'customers' => $customerList
        ]);
    }
}
