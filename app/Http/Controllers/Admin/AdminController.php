<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Queries\SearchUsers;
use App\Http\Controllers\Controller;
use App\Http\Middleware\VerifyAdmins;
use Illuminate\Auth\Middleware\Authenticate;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class, VerifyAdmins::class]);
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
