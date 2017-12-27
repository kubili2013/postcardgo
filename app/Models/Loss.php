<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loss extends Model
{
    use SoftDeletes;
    const TABLE = 'losses';

    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;
    protected $fillable = [
        'loss_id','new_id'
    ];

    public function oldOne():?Postcard
    {
        return $this->belongsTo(Postcard::class,'loss_id');
    }

    public function newOne():?Postcard
    {
        return $this->belongsTo(Postcard::class,'new_id');
    }
}
