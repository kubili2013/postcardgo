<?php

namespace App\Http\Controllers\Admin;

use App\Http\Middleware\VerifyAdmins;
use App\Http\Requests\PostcardRequest;
use App\Jobs\CreatePostcard;
use App\Jobs\UpdatePostcard;
use App\Models\Postcard;
use App\Policies\PostcardPolicy;
use App\Queries\SearchPostcards;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostcardController extends Controller
{

    public function __construct()
    {
        $this->middleware([Authenticate::class, VerifyAdmins::class]);
    }

    public function index()
    {
        $search = request('search');
        $postcards = $search ? SearchPostcards::get($search) : Postcard::findAllPaginated();

        return view('admin.postcards', compact('postcards', 'search'));
    }

    public function create(){
        return view('admin.postcards.create');
    }


    public function store(PostcardRequest $request){
        $postcard = $this->dispatchNow(CreatePostcard::fromRequest($request));
        return $postcard;
    }

    public function show(Postcard $postcard){
        $this->authorize(PostcardPolicy::UPDATE, $postcard);
        return view('admin.postcards.edit', compact('postcard'));
    }

    public function edit(Postcard $postcard){
        $this->authorize(PostcardPolicy::UPDATE, $postcard);

        return view('admin.postcards.edit', compact('postcard'));
    }

    public function update(Postcard $postcard, PostcardRequest $request){
        $this->authorize(PostcardPolicy::UPDATE, $postcard);

        if($postcard->status != "created"){
            $this->error('postcard.made.updated.fail');
            return view('admin.postcards.edit', compact('postcard'));
        }
        $postcard = $this->dispatchNow(UpdatePostcard::fromRequest($postcard,$request));
        $this->success('postcard.updated');
        return view('admin.postcards.edit', compact('postcard'));
    }

}
