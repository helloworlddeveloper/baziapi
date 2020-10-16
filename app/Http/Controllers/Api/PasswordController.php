<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * User: 白小飞
     * DateTime: 2020-09-15-0015 15:57
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * 点击忘记密码，然后给邮箱发送重置链接
     */
    public function changePassword(Request $request)
    {
        //比对Email
        $user = User::where('email', $request->email)
            ->firstOr(function () {
                return false;
            });

        //如果找不到用户返回403
        if ($user === false) {
            return response()->json([
                'message' => '非注册邮箱，请重试。',
            ], 403);
        }

        //如果Email匹配，发送重置链接，生成token和过期时间，并且存入数据库，传入邮件视图
        $mailData = array(
            'email' => $request->email,
            'created_at' => date('Y-m-d H:i:s', strtotime('+ 1 day')),
            'token' => \Str::random(90),
        );
        //存入表
        $res = PasswordReset::create($mailData);
        //发送激活邮件
        \Mail::to($user->email)->send(new \App\Mail\PasswordResetMail($mailData));

        return response()->json([
            'message' => '邮件已发送，请前往您的注册邮箱查看。',
            'data' => $mailData
        ], 200);
    }

    public function doChangePassword(ChangePasswordRequest $request)
    {
        //校验是否过期
        //比对时间
        //$tomorrow = strtotime(date("Y-m-d H:m", strtotime("+1hour")));
        $contrasTime = strtotime($request->created_at) > time();

        //校验数据
        $res = PasswordReset::where(['email' => $request->email, 'token' => $request->token])
            ->firstOr(function () {
                return false;
            });

        if ($res && $contrasTime) {
            //更新密码
            User::where('email', $request->email)
                ->update(['password' => password_hash($request->password, PASSWORD_DEFAULT)]);
            //更新完成，删除对应passwordResets表数据。
            PasswordReset::where('email', $request->email)->delete();

            return response()->json([
                'message' => '密码重置成功，请重新登陆。',
            ], 200);
        } else {
            //全部判定为重置链接超期，直接删除对应passwordResets表数据。
            PasswordReset::where('email', $request->email)->delete();
            return response()->json([
                'message' => '重置链接超期，请重新找回密码。',
            ], 403);
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        //比对原密码
        if (!password_verify($request->password, \Auth::user()->password)) {
            return response()->json([
                'message' => '原密码错误',
            ], 403);
        }

        //修改密码
        User::where('id', \Auth::user()->id)
            ->update(['password' => password_hash($request->resetPassword, PASSWORD_DEFAULT)]);

        //撤销授权，重新登陆
        revoked();
        return response()->json([
            'message' => '密码重置成功，请重新登陆。',
        ], 200);
    }
}
