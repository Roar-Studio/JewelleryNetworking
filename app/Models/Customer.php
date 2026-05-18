<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory;
    protected $table = 'customers';
    protected $guarded = [];

    // protected $fillable = ['name', 'email', 'password', 'session_id'];

    protected $hidden = ['password', 'remember_token'];

    public function membership_plan(){
        return $this->belongsTo(\App\Models\MembershipPlan::class, 'plan_type');
    }

    public function transactions(){
        return $this->hasMany(\App\Models\TransactionDetail::class, 'customer_id');
    }

    public function media_images(){
        return $this->hasMany(MediaImage::class, 'customer_id');
    }
}
