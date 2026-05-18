<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Functions extends Model
{
    public static function generateApplicationNumber($license_code,$form_type)
    {
        $characters = '0123456789';
        $autoIncString = '';
        // echo $form_type;
        // dd($license_code);
        $inc_no = LookupValues::where('type', $form_type)->where('lookup_id', 10)->first();
        $autoIncString = $inc_no->value + 1;

        $inc_no->value = $inc_no->value + 1;
        $inc_no->save();

        if($form_type == 'NewConnection'){
            $letter = 'NW';
        }
        elseif($form_type == 'NameChange'){
            $letter = 'NM';
        }
        else{
            $letter = substr($form_type, 0, 1);
        }
        // for ($i = 0; $i < 4; $i++) {
        //     $index = rand(0, strlen($characters) - 1);
        //     $autoIncString .= $characters[$index];
        // }

        return substr($license_code, 0, 1).'/'.date("Y").'/'.$letter.sprintf("%04d", $autoIncString);
    }

    public static function maskEmail($email)
    {
        // Split the email into local and domain parts
        [$local, $domain] = explode('@', $email);

        // If local part is less than or equal to 2 characters, return it with only the first character and the last (or pad with *).
        $length = strlen($local);

        if ($length <= 2) {
            $maskedLocal = substr($local, 0, 1) . str_repeat('*', $length - 1);
        } else {
            $maskedLocal = substr($local, 0, 1) . str_repeat('*', $length - 2) . substr($local, -1);
        }

        return $maskedLocal . '@' . $domain;
    }

    public static function generateOTP()
    {
        $characters = '123456789';
        $randomString = '';

        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];

        for ($i = 1; $i < 6; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public static function sendOTP($uid)
    {
        $token = Str::random(60);
        
        $otp = new OtpMaster();
        $otp->customer_id = $uid;
        $otp->token = $token;
        $otp->otp = self::generateOTP();
        $otp->status = 0;
        $otp->save();

        OtpRequest::create([
            'customer_id' => $uid,
            'requested_at' => Carbon::now()
        ]);
        return $otp;
    }

}
