<?php

namespace App\Http\Controllers\Admin;

use App\Events\RegisterUserEvent;
use App\Events\SystemMessage;
use App\Http\Controllers\Api\GetMessageController;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\NotifiationStatus;
use App\Models\User;
use Illuminate\Http\Request;

//class MessageController extends Controller
class MessageController extends GetMessageController
{
    public $msg;
    public $publicRes;

    public function getAll()
    {
        $total = Message::query()->count();
        $msg = Message::query()->latest()->get();

        return response()->json([
            'message' => '查询成功',
            'data' => $msg,
            'total' => $total,
        ]);
    }

    public function add(MessageRequest $request)
    {
        $insert = $request->all();
        $insert['isrevoke'] = 0;
        $insert['isread'] = 0;
        $this->msg = Message::query()->create($insert);

        if ($request->message_type == '公共信息') {
            $users = User::all();
            foreach ($users as $user) {
                \DB::table('_notification_status')
                    ->insert([
                        'not_id' => $this->msg->id,
                        'not_uid' => $user->id,
                        'not_isread' => 0,
                        'not_bak_1' => 0,
                    ]);
            }
        }

        return response()->json([
            'message' => '添加成功',
        ]);
    }

    public function edit(MessageRequest $request)
    {
        Message::query()->where('id', $request->id)
            ->update($request->except('id'));

        return response()->json([
            'message' => '修改成功',
        ]);
    }

    public function del(Request $request)
    {
        Message::destroy($request->id);
        NotifiationStatus::query()
            ->where('not_id', $request->id)
            ->delete();


        return response()->json([
            'message' => '删除成功',
        ]);
    }

    public function send(Request $request)
    {
        if ($request->message_type == '公共信息') {
            $updateSta = Message::query()->find($request->id);
            $updateSta->sendtime = date('Y-m-d H:i:s', time());
            $updateSta->save();

            //设置显示状态为可读取
            $status = NotifiationStatus::query()
                ->where('not_id', $request->id)->get();

            foreach ($status as $statu) {
                $statu->not_bak_1 = 1;
                $statu->not_bak_2 = 1;
                $statu->save();
            }

            $sysMsg = 'publicMessage';
            event(new SystemMessage($sysMsg));
        }

        if ($request->message_type == '私有信息') {
            $updateSta = Message::query()->find($request->id);
            $updateSta->bak_2 = 1; //已推送的
            $updateSta->save();

            $user = User::query()->findOrFail($request->uid);
//            $msg = Message::query()->findOrFail($request->id);

            $msg = 'privateMessage';
            broadcast(new RegisterUserEvent($user, $msg));
        }
    }
}

