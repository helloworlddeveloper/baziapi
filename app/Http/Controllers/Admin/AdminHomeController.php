<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AdminHomeController extends Controller
{
    public $users;

    public function __construct()
    {
        $this->middleware('revalidate');
    }

    public function home()
    {
        $all = User::all();
        $activity = User::where('is_activity', 1)->get();
        return view('admin.home.adminHome')
            ->with([
                'all' => count($all),
                'activity' => count($activity)
            ]);
    }

    public function list()
    {
        $all = User::simplePaginate(15);
        return view('admin.home.adminHome')
            ->with([
                'all' => $all
            ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        return redirect('admin/login');
    }
}
