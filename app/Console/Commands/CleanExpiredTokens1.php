<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Customer;
use Carbon\Carbon;

class CleanExpiredTokens1 extends Command
{
    protected $signature = 'sanctum:cleanup-expired';
    protected $description = 'Remove expired tokens and clear stale device IDs.';

    public function handle()
    {
        $now = Carbon::now();

        // Delete expired tokens
        PersonalAccessToken::whereNotNull('expires_at')
            ->where('expires_at', '<=', $now)
            ->delete();

        // Clear stale user device IDs
        Customer::chunk(200, function ($users) use ($now) {
            foreach ($users as $u) {
                $hasMobile = PersonalAccessToken::where('tokenable_type', get_class($u))
                    ->where('tokenable_id', $u->id)
                    ->where('device_type', 'mobile')
                    ->where(function($q) use ($now) {
                        $q->whereNull('expires_at')->orWhere('expires_at', '>', $now);
                    })
                    ->exists();

                $hasDesktop = PersonalAccessToken::where('tokenable_type', get_class($u))
                    ->where('tokenable_id', $u->id)
                    ->where('device_type', 'desktop')
                    ->where(function($q) use ($now) {
                        $q->whereNull('expires_at')->orWhere('expires_at', '>', $now);
                    })
                    ->exists();

                if (!$hasMobile && $u->mobile_device_id) $u->mobile_device_id = null;
                if (!$hasDesktop && $u->desktop_device_id) $u->desktop_device_id = null;
                if ($u->isDirty()) $u->save();
            }
        });

        $this->info('Expired tokens and stale device IDs cleaned.');
    }
}
