<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\models\TransactionDetail;

class MediaImage extends Model
{
    use HasFactory;
    protected $table = 'media_images';
    protected $guarded = [];
    
}
