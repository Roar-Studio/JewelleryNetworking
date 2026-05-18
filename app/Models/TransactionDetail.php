<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';
    // protected $fillable = [
    //     'transaction_id', 'user_id', 'transactionable_id', 'transactionable_type', 
    //     'amount', 'status', 'payment_method', 'transaction_reference', 'payment_date'
    // ];
    protected $guarded = [];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function customer(){
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }

    public function coupon(){
        return $this->belongsTo(\App\Models\Coupon::class, 'coupon_id');
    }
}
