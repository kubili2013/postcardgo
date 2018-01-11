<?php

namespace App\Http\Controllers;

use App\Models\Postcard;
use App\Policies\PostcardPolicy;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

class PostcardController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }
    //
    public function show(Postcard $postcard){
        $this->authorize(PostcardPolicy::UPDATE, $postcard);
        return view("users.postcard.show", compact('postcard'));
    }

    public function update(Postcard $postcard){
        $this->authorize(PostcardPolicy::UPDATE, $postcard);
        return view("users.postcard.show", compact('postcard'));
    }
}
