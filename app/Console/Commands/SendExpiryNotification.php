<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ExpiryNotificationService;

class SendExpiryNotification extends Command
{
    protected $signature = 'email:send-expiry-notification';
    protected $description = 'Send expiry notification email';

    public function handle(ExpiryNotificationService $service)
    {
        $service->process();
        $this->info('Expiry notification email process completed.');
        return 0; // Always return integer
    }
}
