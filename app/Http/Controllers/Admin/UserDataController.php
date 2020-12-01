<?php

namespace App\Http\Controllers\Admin;

use App\Events\RegisterUserEvent;
use App\Http\Controllers\Controller;
use App\Models\MingPan;
use App\Models\User;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public $params;

    public function getAll(Request $request)
    {
        if ($request->searchInput) {
            $users = $this->queryInput($request->searchInput);
        } else {
            $users = User::query()->latest()->paginate(30);
        }
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
            ->where('user_type', 1)
            ->count();
        $forever = User::query()
            ->where('user_type', 8)
            ->count();

        return response()->json([
            'message' => 'Success Get',
            'data' => $users,
            'total' => $total,
            'activeTotal' => $activeTotal,
            'xTotal' => $xTotal,
            'membersTotal' => $membersTotal,
            'forever' => $forever,
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
        if ($request->user_type == 8) {
            $this->forever($request->id);
        }
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

    //开通1一年期会员
    public function setMember(Request $request)
    {
        $user = User::query()->findOrFail($request->id);
        $user->user_type = 1;
        if ($user->membertime) {
            $t = strtotime($user->membertime);
            $user->membertime = date("Y-m-d H:m:s", $t + 365 * 24 * 60 * 60);
        } else {
            $user->membertime = date("Y-m-d H:m:s", strtotime("+ 1 year"));
        }

        $user->save();
        $msg = [
            'type' => 'member',
            'msg' => '恭喜您，您以成功订阅本站点。',
            'ini' => 1,
            'time' => $user->membertime,
        ];
        broadcast(new RegisterUserEvent($user, $msg));

        return response()->json([
            'message' => '该账号已开通订阅会员。',
        ], 200);
    }

    //永久会员
    public function forever($id)
    {
        $user = User::query()->findOrFail($id);
        $user->user_type = 8;
        $user->membertime = date("Y-m-d H:m:s", 4070880000);

        $user->save();
        $msg = [
            'type' => 'member',
            'ini' => 8,
            'msg' => '恭喜您，您以成为本站永久会员。',
        ];
        broadcast(new RegisterUserEvent($user, $msg));

        return response()->json([
            'message' => '该账号已开通永久会员。',
        ], 200);
    }
}
