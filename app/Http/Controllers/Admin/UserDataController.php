<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MingPan;
use App\Models\User;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public $params;

    public function getAll(Request $request)
    {
        $users = User::query()->latest()->paginate(30);

        //注册
        $total = User::query()->count();

        //激活
        $activeTotal = User::query()
            ->where('is_activity', 1)->count();
        //受限
        $xTotal = User::query()
            ->where('user_type', 9)->count();
        //会员
        $membersTotal = User::query()
            ->where('user_type', 1)->count();

        return response()->json([
            'message' => 'Success Get',
            'data' => $users,
            'total' => $total,
            'activeTotal' => $activeTotal,
            'xTotal' => $xTotal,
            'membersTotal' => $membersTotal,
        ], 200);
    }

    public function edit(Request $request)
    {
        $user = User::query()
            ->where('id', $request->id)
            ->update([
                'username' => $request->username,
                'email' => $request->email,
                'user_type' => $request->user_type,
                'is_activity' => $request->is_activity,
            ]);

        if ($user) {
            return response()->json([
                'message' => 'Success Edit',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Edit',
            ], 403);
        }
    }

//独立input查询
    public function queryInput($data)
    {
        $this->params = $data;
        return User::query()
            ->where(function ($query) {
                $query
                    ->orwhere('id', 'like', '%' . $this->params . '%')
                    ->orwhere('username', 'like', '%' . $this->params . '%')
                    ->orwhere('user_type', 'like', '%' . $this->params . '%')
                    ->orwhere('is_activity', 'like', '%' . $this->params . '%')
                    ->orwhere('email', 'like', '%' . $this->params . '%')
                    ->orwhere('storage_3', 'like', '%' . $this->params . '%')
                    ->orwhere('created_at', 'like', '%' . $this->params . '%');
            })->latest()->paginate(30);
    }
}
