<?php

namespace App\Models;

use App\Models\Customer;
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

        /*
        |--------------------------------------------------------------------------
        | Technical Information
        |--------------------------------------------------------------------------
        */
        'customer_id',
        'entry_id',

        /*
        |--------------------------------------------------------------------------
        | Participant Information
        |--------------------------------------------------------------------------
        */
        'first_name',
        'last_name',
        'email',
        'phone',
        'city',
        'country',
        'organisation',
        'participant_type',

        /*
        |--------------------------------------------------------------------------
        | Entry A
        |--------------------------------------------------------------------------
        */
        'deity_category_a',
        'jewellery_piece_a',
        'material_a',
        'statement_a',
        'images_a',

        /*
        |--------------------------------------------------------------------------
        | Entry B
        |--------------------------------------------------------------------------
        */
        'deity_category_b',
        'jewellery_piece_b',
        'material_b',
        'statement_b',
        'images_b',

        /*
        |--------------------------------------------------------------------------
        | Declaration
        |--------------------------------------------------------------------------
        */
        'declaration',

        /*
        |--------------------------------------------------------------------------
        | Submission Status
        |--------------------------------------------------------------------------
        */
        'status',
    ];

    /**
     * Cast Attributes
     */
    protected $casts = [

        'images_a' => 'array',

        'images_b' => 'array',

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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function isPaymentDone(): bool
    {
        return $this->transactions()
            ->where('status', 'completed')
            ->exists();
    }
}
