<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TransactionDetail;

class MembershipPlan extends Model
{
    use HasFactory;

    protected $table = 'membership_plans';

    // Optional: Add fillable or guarded
    // protected $fillable = ['name', 'price', 'duration'];
    protected $guarded = [];

    public function transactions()
    {
        return $this->morphMany(TransactionDetail::class, 'transactionable');
    }
}
