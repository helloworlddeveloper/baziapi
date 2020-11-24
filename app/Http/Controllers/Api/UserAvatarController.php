<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImgRequest;
use App\Http\Requests\TopHeadImageRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Storage;

class UserAvatarController extends Controller
{
    public function upload(ImgRequest $request)
    {
        $user = User::find(\Auth::id());
        if ($user->user_type != 1) {
            return response()->json([
                'message' => '您还没有订阅，订阅用户特权。',
            ], 403);
        }
        //首次修改
        if ($user->storage_2 === null || $user->avatar === null) {
            $avatar = $request->file('avatar')->store('public');
            $user->storage_2 = 1;
            $user->avatar = $avatar;
            $user->save();
            return response()->json([
                'message' => '修改成功',
                'avatar' => Storage::url($avatar),
                'avatarPath' => $avatar,
            ], 200);
        } elseif ($request->avatarPath) {
            $contents = Storage::exists($request->avatarPath);
            //查找图片是否存在，存在即可保存图片，如果不存在需要判断store_1是否为1，如果存在为1，即为非法提交
            if ($contents) {
                Storage::delete($request->avatarPath);
                $avatar = $request->file('avatar')->store('public');
                $user->avatar = $avatar;
                $user->save();
                return response()->json([
                    'message' => '修改成功',
                    'avatar' => Storage::url($avatar),
                    'avatarPath' => $avatar,
                ], 200);
            } else {
                return response()->json([
                    'message' => '非法操作',
                ], 403);
            }
        }
        return response()->json([
            'message' => '未知错误',
        ], 403);
    }

    public function TopLogo(TopHeadImageRequest $request)
    {
        $user = User::find(\Auth::id());
        if (!$user->user_type) {
            return response()->json([
                'message' => '您还没有订阅，订阅用户特权。',
            ], 403);
        }
        //首次修改
        if ($user->storage_1 === null || $user->head_logo === null) {
            $head_logo = $request->file('head_logo')->store('headLogos');
            $user->storage_1 = 1;
            $user->head_logo = $head_logo;
            $user->save();
            return response()->json([
                'message' => '修改成功',
                'TopLogo' => Storage::url($head_logo),
                'TopLogoPath' => $head_logo,
            ], 200);
        } elseif ($request->TopLogoPath) {
            $contents = Storage::exists($request->TopLogoPath);
            //查找图片是否存在，存在即可保存图片，如果不存在需要判断store_1是否为1，如果存在为1，即为非法提交
            if ($contents) {
                Storage::delete($request->TopLogoPath);
                $head_logo = $request->file('head_logo')->store('headLogos');
                $user->head_logo = $head_logo;
                $user->save();
                return response()->json([
                    'message' => '修改成功',
                    'TopLogo' => Storage::url($head_logo),
                    'TopLogoPath' => $head_logo,
                ], 200);
            } else {
                return response()->json([
                    'message' => '非法操作',
                ], 403);
            }
        }
        return response()->json([
            'message' => '未知错误',
        ], 403);
    }
}
