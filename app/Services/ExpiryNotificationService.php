<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\ExpiryNotificationMail;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\MembershipPlan;

class ExpiryNotificationService
{
    public function process()
    {
        $today = Carbon::today();

        $customerList = Customer::with('membership_plan')
            ->whereNotNull('plan_expired_at')
            ->whereHas('membership_plan', function ($query) {
                $query->where('plan_type', '>', 1);
            })
            ->orderBy('plan_expired_at', 'asc')
            ->get();

        foreach ($customerList as $customer) {
            $daysUntilExpiry = $today->diffInDays($customer->plan_expired_at, false);

            $sendEmail = false;
            $status = '';

            $beforeDays = [30, 7, 3, 2, 1];
            if (in_array($daysUntilExpiry, $beforeDays)) {
                $sendEmail = true;
                $status = 'expiring';
            }

            $afterDays = [-1, -2, -3, -4];
            if (in_array($daysUntilExpiry, $afterDays)) {
                $sendEmail = true;
                $status = 'expired';
            }

            if ($sendEmail) {
                //return $customer->email;
                Mail::to($customer->email)->send(
                    new ExpiryNotificationMail(
                        $customer->first_name . ' ' . $customer->last_name,
                        \Carbon\Carbon::parse($customer->plan_expired_at)->format('Y-m-d'),
                        $customer->membership_plan->name,
                        $customer->benefits,
                        $status
                    )
                );
            }

            if ($daysUntilExpiry === -4) {
                $customer->plan_type = 1; // Reset to 'Free' plan
                $customer->plan_expired_at = null;
                $customer->plan_started_at = null;
                $customer->save();
            }
        }

        //return $customerList;
    }
}
