<?php

namespace App\Http\Controllers\Message;

use App\Events\RegisterUserEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserMessageRequest;
use App\Models\ReplyUserMessage;
use App\Models\User;
use App\Models\UserMessage;
use Illuminate\Http\Request;

class UserMessageController extends Controller
{
    public $newArr = [];

    public function get()
    {
        $res1 = UserMessage::query()
            ->where([
                ['uid', '=', \Auth::id()],
                ['is_revoke', '=', 0]
            ])
            ->select(
                'messagepads.id',
                'messagepads.uid',
                'messagepads.message_content',
                'messagepads.message_time',
                'messagepads.is_read',
                'messagepads.is_revoke',
                'messagepads.created_at',
            )
            ->latest()
            ->get();
        $this->newArr['messages'] = $res1;
        $res1->map(function ($v, $k) {
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

        return response()->json([
            'data' => $this->newArr,
            'message' => '留言成功',
        ]);
    }

    public function store(UserMessageRequest $request)
    {
        $res = UserMessage::query()->create([
            'uid' => \Auth::id(),
            'message_content' => $request->message_content,
            'message_time' => date('Y-m-d H:i:s', time()),
        ]);
        $data = UserMessage::query()
            ->select('id', 'uid', 'message_content', 'message_time', 'is_read', 'is_revoke')
            ->where('id', $res->id)
            ->get();
        return response()->json([
            'data' => $data,
            'message' => '留言成功'
        ], 200);
    }

    public function delMessage(Request $request)
    {
        UserMessage::query()
            ->where('id', $request->id)
            ->update(['is_revoke' => 1]);

        return response()->json([
            'message' => '删除成功'
        ], 200);
    }

    public function noReadReply(Request $request)
    {
        if ($request->read == 'read') {
            ReplyUserMessage::query()
                ->where('uid', '=', \Auth::id())
                ->update(['reply_is_read' => 1]);
        } else {
            $noReadReplyCount = ReplyUserMessage::query()
                ->where([
                    ['uid', '=', \Auth::id()],
                    ['reply_is_read', '=', 0],
                ])
                ->count();

            return response()->json([
                'data' => $noReadReplyCount
            ], 200);
        }
    }
}
