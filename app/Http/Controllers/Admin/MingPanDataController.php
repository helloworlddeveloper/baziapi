<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MingPan;
use App\Models\User;
use Illuminate\Http\Request;

class MingPanDataController extends Controller
{
    public function getAll(Request $request)
    {
        //得到命盘对应的用户
        $ids = \DB::table('ming_pan')->latest()->pluck('user_id');
        $username = [];
        foreach ($ids as $id) {
            $username[] = User::query()->where('id', $id)
                ->select('username')->latest()->get();
        }

        //得到用户总数
        $total = MingPan::query()->count();

        if (!$request->input) {
            $users = MingPan::query()
                ->latest()->paginate(50);
        } else {
            $users = $this->queryInput($request->input);
        }

        //插入每个用户的命盘总数
        foreach ($users as $key => $value) {
            $value['owner'] = $username[$key];
        }

        return response()->json([
            'message' => 'Success Get',
            'data' => $users,
            'total' => $total,
        ], 200);
    }

    //独立input查询
    public function queryInput($data)
    {
        $this->params = $data;
        return MingPan::query()
            ->where('user_id', \Auth::id())
            ->where(function ($query) {
                $query
                    ->orwhere('bak1', 'like', '%' . $this->params . '%')
                    ->orwhere('name', 'like', '%' . $this->params . '%')
                    ->orwhere('sex', 'like', '%' . $this->params . '%')
                    ->orwhere('call', 'like', '%' . $this->params . '%')
                    ->orwhere('born', 'like', '%' . $this->params . '%')
                    ->orwhere('area', 'like', '%' . $this->params . '%')
                    ->orwhere('type', 'like', '%' . $this->params . '%')
                    ->orwhere('desc', 'like', '%' . $this->params . '%');
            })
            ->latest()
            ->paginate(50);
    }
}
