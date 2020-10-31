<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MingPanEditRequest;
use App\Http\Requests\MingPanRequest;
use App\Models\MingPan;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class MingPanController extends Controller
{
    public $params;

    //创建
    public function store(MingPanRequest $request)
    {
        $data = $this->create($request->all());
        return response()->json([
            'message' => '创建成功',
            'data' => json_encode($data, JSON_UNESCAPED_UNICODE),
        ], 200);
    }

    //查询数据
    public function show(Request $request)
    {
        if (!$request->input) {
            $mingPanList = $this->queryData();
        }
        //只查询input
        if ($request->input && !$request->select) {
            $mingPanList = $this->queryInput($request->input);
        }
        //同时存在
        if ($request->select && $request->input) {
            $mingPanList = $this->querySelectInput($request->all());
        }
        return response()->json([
            'message' => '数据查询成功',
            'data' => $mingPanList,
        ], 200);
    }

    //修改数据
    public function edit(MingPanEditRequest $request)
    {
        $sta = $this->upData($request->all());
        return response()->json([
            'message' => '数据修改成功',
            'data' => $sta,
        ], 200);
    }

    //默认查询
    public function queryData()
    {
        return MingPan::query()
            ->where('user_id', \Auth::id())
            ->latest()
            ->paginate(15);
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
                    ->orwhere('call', 'like', '%' . $this->params . '%')
                    ->orwhere('born', 'like', '%' . $this->params . '%')
                    ->orwhere('area', 'like', '%' . $this->params . '%')
                    ->orwhere('type', 'like', '%' . $this->params . '%')
                    ->orwhere('desc', 'like', '%' . $this->params . '%');
            })
            ->latest()
            ->paginate(15);
    }

    //select和input联合查询
    public function querySelectInput(array $data)
    {
        $select = $data['select'];
        $input = $data['input'];
        return MingPan::query()
            ->where('user_id', \Auth::id())
            ->where($select, $input)
            ->latest()
            ->paginate(15);
    }

    //删除
    public function del(Request $request)
    {
        $delState = MingPan::destroy($request->id);
        if (!$delState) {
            return response()->json([
                'message' => '数据不存在（发生错误）',
            ], 403);
        }
        return response()->json([
            'message' => '数据删除成功',
        ], 200);
    }

    //插入数
    public function create(array $data)
    {
        return MingPan::query()->create([
            'user_id' => $data['id'],
            'year' => $data['year'],
            'month' => $data['month'],
            'day' => $data['day'],
            'hour' => $data['hour'],
            'minute' => $data['minute'],
            'sex' => $data['sex'],
            'name' => $data['name'],
            'call' => $data['call'],
            'born' => $data['born'],
            'area' => $data['area'],
            'type' => json_encode($data['type'], JSON_UNESCAPED_UNICODE),
            'desc' => $data['desc'],
            'bak1' => $data['baZiTime'],
        ]);
    }

    //更新数据
    public function upData(array $data)
    {
        $user = MingPan::query()->find($data['id']);

        $user->year = $data['year'];
        $user->month = $data['month'];
        $user->day = $data['day'];
        $user->hour = $data['hour'];
        $user->minute = $data['minute'];
        $user->sex = $data['sex'];
        $user->name = $data['name'];
        $user->call = $data['call'];
        $user->born = $data['born'];
        $user->area = $data['area'];
        $user->type = json_encode($data['type'], JSON_UNESCAPED_UNICODE);
        $user->desc = $data['desc'];
        $user->bak1 = $data['baZiTime'];
        $user->save();

        return $user;
    }
}
