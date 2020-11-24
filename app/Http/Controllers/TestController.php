<?php

namespace App\Http\Controllers;

use App\Models\ReplyUserMessage;
use App\Models\User;
use App\Models\UserMessage;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public $newArr = [];

//    public function test()
//    {
//        $res1 = UserMessage::query()
//            ->join('users', 'messagepads.uid', '=', 'users.id')
//            ->select(
//                'messagepads.id',
//                'messagepads.uid',
//                'messagepads.message_content',
//                'messagepads.message_time',
//                'messagepads.is_read',
//                'messagepads.is_revoke',
//                'messagepads.created_at',
//                'users.username',
//            )
//            ->latest()
//            ->get();
//
//        $res2 = $res1->groupBy(['uid', 'id']);
//
//        $change = $res2->map(function ($v, $k) {
//            $this->newArr['uid'] = $k;
//            $this->newArr['username'] = User::query()->where('id', $k)->value('username');
//
//            $message = UserMessage::query()
//                ->where('uid', $k)
//                ->select(
//                    'messagepads.id',
//                    'messagepads.uid',
//                    'messagepads.message_content',
//                    'messagepads.message_time',
//                    'messagepads.is_read',
//                    'messagepads.is_revoke',
//                    'messagepads.created_at',
//                )
//                ->latest()
//                ->get();
//
//            $this->newArr['messages'] = $message;
//
//            $message->map(function ($v, $k) {
//                $reply = ReplyUserMessage::query()
//                    ->where('mid', $v->id)
//                    ->select(
//                        'admin_reply_messages.id',
//                        'admin_reply_messages.mid',
//                        'admin_reply_messages.uid',
//                        'admin_reply_messages.reply_message_content',
//                        'admin_reply_messages.reply_message_time',
//                        'admin_reply_messages.reply_is_revoke',
//                        'admin_reply_messages.created_at',
//                    )
//                    ->latest()
//                    ->get();
//
//                $this->newArr['messages'][$k]['reply'] = $reply;
//            });
//            return $this->newArr;
//        });
//
//        return response()->json([
//            'data' => $res1
//        ]);
//    }

    public function test()
    {
        $res1 = UserMessage::query()
            ->where('uid', 1)
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
        $change = $res1->map(function ($v, $k) {
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
            'data' => $res1,
            'message' => '留言成功',
        ]);
    }


    public function test2()
    {
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
            'data' => $change
        ]);
    }
}