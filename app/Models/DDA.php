<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DDA extends Model
{
    use HasFactory;

    /**
     * Table Name
     */
    protected $table = 'dda';

    /**
     * Primary Key
     */
    protected $primaryKey = 'id';

    /**
     * Allow Mass Assignment
     */
    protected $fillable = [
        'entry_id',

        // Participant Information
        'first_name',
        'last_name',
        'email',
        'phone',
        'city',
        'country',
        'organisation',
        'participant_type',

        // Entry Details
        'piece_name',
        'award_category',
        'materials',
        'year',
        'deity',
        'statement',

        // Images
        'images',

        // Declaration
        'declaration',

        // Submission Status
        'status',
    ];

    /**
     * Cast Attributes
     */
    protected $casts = [
        'images' => 'array',
        'declaration' => 'boolean',
    ];

    /**
     * Relationship:
     * One Submission can have many Payment Transactions
     */
    public function transactions()
    {
        return $this->hasMany(DdaTransaction::class, 'dda_id', 'id');
    }
}