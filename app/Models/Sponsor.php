<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\models\TransactionDetail;

class Sponsor extends Model
{
    use HasFactory;
    protected $table = 'sponsors';
    protected $guarded = [];
    
}
