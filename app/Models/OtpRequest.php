<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtpRequest extends Model
{
    protected $table = 'otp_requests';
    
    use HasFactory;
    
    protected $guarded = [];
}
