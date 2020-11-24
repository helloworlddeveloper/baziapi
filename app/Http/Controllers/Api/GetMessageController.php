<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\NotifiationStatus;
use Illuminate\Http\Request;

class GetMessageController extends Controller
{
    public $publicRes = [];
    public $privateRes;

    public function getMessage(Request $request)
    {
        $this->privateRes = Message::query()
            ->where([
                ['uid', \Auth::id()],
                ['message_type', '私有信息'],
                ['bak_2', 1],
                ['isrevoke', 0],
            ])
            ->select('id', 'uid', 'usertype', 'title', 'message', 'message_type', 'isread', 'isrevoke', 'sendtime')
            ->get();

        //取出每个用户对应的公共信息ID
        $statusId = NotifiationStatus::query()
            ->select('not_uid', 'not_id', 'not_isread', 'not_bak_1')
            ->where([
                ['not_uid', \Auth::id()],
                ['not_bak_1', 1]
            ])->pluck('not_id');

        //检索出对应的公共信息
        $publicMessage = Message::query()
            ->select('title', 'message', 'id', 'message_type', 'sendtime')
            ->whereIn('id', $statusId)
            ->get();

        //拿到没个用户对应的公共信息状态
        $status = NotifiationStatus::query()
            ->select('not_uid', 'not_id', 'not_isread', 'not_bak_1', 'id')
            ->where([
                ['not_uid', \Auth::id()],
                ['not_bak_1', 1]
            ])->get();

        //进行合并
        foreach ($status as $key => $value) {
            $this->publicRes[$key]['title'] = $publicMessage[$key]['title'];
            $this->publicRes[$key]['message'] = $publicMessage[$key]['message'];
            $this->publicRes[$key]['id'] = $publicMessage[$key]['id'];
            $this->publicRes[$key]['sendtime'] = $publicMessage[$key]['sendtime'];
            $this->publicRes[$key]['not_uid'] = $value['not_uid'];
            $this->publicRes[$key]['not_id'] = $value['not_id'];
            $this->publicRes[$key]['not_isread'] = $value['not_isread'];
            $this->publicRes[$key]['not_bak_1'] = $value['not_bak_1'];
            $this->publicRes[$key]['not_statu_id'] = $value['id'];
        }

        $publicTotal = NotifiationStatus::query()
            ->where([
                ['not_uid', \Auth::id()],
                ['not_isread', 0],
                ['not_bak_2', 1],
            ])->count();

        $privateTotal = Message::query()
            ->where([
                ['uid', \Auth::id()],
                ['message_type', '私有信息'],
                ['bak_2', 1],
                ['isread', 0],
                ['isrevoke', 0],
            ])
            ->count();

        return response()->json([
            'data' => [
                'publicMessage' => json_decode(json_encode($this->publicRes), true),
                'privateMessage' => $this->privateRes,
                'publicTotal' => $publicTotal + $privateTotal,
            ],
        ], 200);
    }

    public function isread(Request $request)
    {
        $sta = NotifiationStatus::query()
            ->find($request->id);
        $sta->not_isread = 1;
        $sta->save();
    }

    public function isrevoke(Request $request)
    {
        $sta = NotifiationStatus::query()
            ->find($request->id);
        $sta->not_bak_1 = 0;
        $sta->save();
    }

    public function privateIsRead(Request $request)
    {
        $updateSta = Message::query()->find($request->id);
        $updateSta->isread = 1; //已推送的
        $updateSta->save();
    }

    public function privateIsRevoke(Request $request)
    {
        $updateSta = Message::query()->find($request->id);
        $updateSta->isrevoke = 1; //已推送的
        $updateSta->save();
    }
}
