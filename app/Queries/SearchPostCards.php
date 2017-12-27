<?php

namespace App\Queries;

use App\Models\Postcard;
use Illuminate\Contracts\Pagination\Paginator;

class SearchPostcards
{
    /**
     * @return \App\User[]
     */
    public static function get(string $keyword, int $perPage = 20): Paginator
    {
        return Postcard::where('real_name', 'like', "%$keyword%")
            ->orWhere('email', 'like', "%$keyword%")
            ->orWhere('country', 'like', "%$keyword%")
            ->orWhere('address','like',"%$keyword%")
            ->paginate($perPage)
            ->appends(['search' => $keyword]);
    }
}
