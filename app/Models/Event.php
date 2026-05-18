<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $guarded = [];

    public function transactions()
    {
        return $this->morphMany(TransactionDetail::class, 'transactionable');
    }

    public function sponsors(){
        return $this->hasMany(Sponsor::class, 'event_id');
    }
    

}
