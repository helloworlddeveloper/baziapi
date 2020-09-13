<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function changePassword(PasswordRequest $request)
    {
        $state = User::where('id', \Auth::user()->id)
            ->update(['password' => password_hash($request->password, PASSWORD_DEFAULT)]);
        revoked();
        return response()->json([
            'message' => '密码修改成功,请重新登陆。',
            'state' => $state
        ], 200);
    }
}
