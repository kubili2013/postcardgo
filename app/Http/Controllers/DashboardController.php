<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authenticate;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    public function show()
    {
        // $postcards = $user->postcards()->paginate(10);
        return view('users.dashboard');
    }
}
