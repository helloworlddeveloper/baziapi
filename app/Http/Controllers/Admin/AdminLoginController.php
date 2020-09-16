<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function login(Request $request)
    {
        return view('admin.adminLogin');
    }
}
