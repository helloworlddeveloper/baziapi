<?php

namespace App\Http\Controllers\Message;

use App\Events\RegisterUserEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\ReplyUserMessage;
use App\Models\User;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Message\UserMessageController;

class ReplyUserMessageController extends Controller
{
    public $newArr = [];
    public $uid = [];

    public function getAllCount()
    {
        $count = UserMessage::all()->count();
        $isReadCount = UserMessage::query()
            ->where('is_read', 0)->count();
        return response()->json([
            'data' => [
                'total' => $count,
                'isRead' => $isReadCount
            ]
        ], 200);
    }

    public function getAll(Request $request)
    {
        if ($request->has('uid')) {
            $res1 = UserMessage::query()
                ->where('uid', $request->uid)
                ->join('users', 'messagepads.uid', '=', 'users.id')
                ->select(
                    'messagepads.id',
                    'messagepads.uid',
                    'messagepads.message_content',
                    'messagepads.message_time',
                    'messagepads.is_read',
                    'messagepads.is_revoke',
                    'messagepads.created_at',
                    'users.username',
                )
                ->latest()
                ->get();
        } else {
            $res1 = UserMessage::query()
                ->join('users', 'messagepads.uid', '=', 'users.id')
                ->select(
                    'messagepads.id',
                    'messagepads.uid',
                    'messagepads.message_content',
                    'messagepads.message_time',
                    'messagepads.is_read',
                    'messagepads.is_revoke',
                    'messagepads.created_at',
                    'users.username',
                )
                ->latest()
                ->get();
        }

        $res2 = $res1->groupBy(['uid', 'id']);

        $change = $res2->map(function ($v, $k) {
            $this->newArr['uid'] = $k;
            $this->newArr['username'] = User::query()->where('id', $k)->value('username');

            $message = UserMessage::query()
                ->where('uid', $k)
                ->select(
                    'messagepads.id',
                    'messagepads.uid',
                    'messagepads.message_content',
                    'messagepads.message_time',
                    'messagepads.is_read',
                    'messagepads.is_revoke',
                    'messagepads.is_reply',
                    'messagepads.created_at',
                )
                ->latest()
                ->get();

            $this->newArr['messages'] = $message;

            $message->map(function ($v, $k) {
                $reply = ReplyUserMessage::query()
                    ->where('mid', $v->id)
                    ->select(
                        'admin_reply_messages.id',
                        'admin_reply_messages.mid',
                        'admin_reply_messages.uid',
                        'admin_reply_messages.reply_message_content',
                        'admin_reply_messages.reply_message_time',
                        'admin_reply_messages.reply_is_revoke',
                        'admin_reply_messages.created_at',
                    )
                    ->latest()
                    ->get();

                $this->newArr['messages'][$k]['reply'] = $reply;
            });
            return $this->newArr;
        });

        return response()->json([
            'data' => $change,
            'message' => '数据拉取成功',
        ]);
    }

    public function getAllNew()
    {
        $res1 = UserMessage::query()
            ->where('is_read', 0)
            ->join('users', 'messagepads.uid', '=', 'users.id')
            ->select(
                'messagepads.id',
                'messagepads.uid',
                'messagepads.message_content',
                'messagepads.message_time',
                'messagepads.is_read',
                'messagepads.is_revoke',
                'messagepads.created_at',
                'users.username',
            )
            ->latest()
            ->get();

        return response()->json([
            'data' => $res1,
            'message' => '查询成功'
        ], 200);
    }

    public function saveReply(Request $request)
    {
        UserMessage::query()
            ->where('id', $request->mid)
            ->update([
                'is_reply' => 1
            ]);
        ReplyUserMessage::query()
            ->create([
                'uid' => $request->uid,
                'mid' => $request->mid,
                'reply_message_content' => $request->reply_message_content,
                'reply_message_time' => date('Y-m-d H:i:s', time()),
            ]);

        $user = User::query()->findOrFail($request->uid);
        $msg = [
            'type' => 'reply',
            'msg' => '您的留言有新的回复'
        ];
        broadcast(new RegisterUserEvent($user, $msg));

        return response()->json([
            'message' => '回复保存成功'
        ]);
    }

    public function delMessage(Request $request)
    {
        UserMessage::query()
            ->where('id', $request->id)
            ->update(['is_revoke' => 1]);
    }

    public function readMessage(Request $request)
    {
        UserMessage::query()
            ->where('id', $request->id)
            ->update(['is_read' => 1]);
    }

    public function editReplyMessage(Request $request)
    {
        ReplyUserMessage::query()
            ->where('id', $request->id)
            ->update([
                'reply_message_content' => $request->reply_message_content,
                'reply_message_time' => date('Y-m-d H:i:s', time()),
            ]);
        return response()->json([
            'message' => '修改成功',
            'editStatus' => 1
        ]);
    }

    public function delReplyMessage(Request $request)
    {
        ReplyUserMessage::destroy($request->id);
        $count = ReplyUserMessage::query()
            ->where('mid', $request->mid)
            ->count();
        if ($count == 0) {
            UserMessage::query()
                ->where('id', $request->mid)
                ->update([
                    'is_reply' => 0
                ]);
        }
        return response()->json([
            'message' => '删除成功' . $count

        ]);
    }
}
