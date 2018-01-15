<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    public function show()
    {
        $postcards = Auth::user()->postcards()->orderBy("updated_at",'desc')->paginate(10);
        return view('users.dashboard', compact('postcards'));
    }
}
