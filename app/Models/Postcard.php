<?php

namespace App\Models;

use App\Helpers\ModelHelpers;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postcard extends Model
{
    use SoftDeletes,ModelHelpers;
    const TABLE = 'postcards';

    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;
    protected $fillable = [
        'email',
        'real_name',
        'type',
        'country',
        'address',
        'postcode',
        'message',
        'status',
        'ip',
        'image',
        'user_id'
    ];



    public function author(): User
    {
        return $this->authorRelation;
    }

    public function authoredBy(User $author)
    {
        $this->authorRelation()->associate($author);
    }

    public function authorRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isAuthoredBy(User $user): bool
    {
        return $this->author()->matches($user);
    }
}
