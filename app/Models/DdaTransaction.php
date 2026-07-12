<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DdaTransaction extends Model
{
    use HasFactory;

    protected $table = 'dda_transactions';

    protected $guarded = [];

    public function submission()
    {
        return $this->belongsTo(DDA::class, 'dda_id');
    }
}