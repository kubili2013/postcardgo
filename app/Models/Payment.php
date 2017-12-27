<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    const TABLE = 'payments';

    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;
    protected $fillable = [
        'payment_id',
        'payer',
        'status',
        'amount',
        'postcard_id'
    ];

}
