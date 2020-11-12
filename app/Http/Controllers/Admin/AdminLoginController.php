<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use Hash;
use GuzzleHttp\Client as Guzzle;

class AdminLoginController extends Controller
{
    protected $clientId;
    protected $clientSecret;
    private $http;

    public function __construct(Guzzle $http)
    {
        //构造函数，取出客户端ID和secret，新建Http对象
        $client = \DB::table('oauth_clients')->where('id', 3)->first();
        $this->clientId = $client->id;
        $this->clientSecret = $client->secret;
        $this->http = $http;
    }

    public function login(AdminLoginRequest $request)
    {
        $user = Admin::where('username', $request->username)
            ->firstOr(function () {
                return false;
            });
        if (!$user) {
            return response()->json([
                'message' => 'Forbidden Unauthorized.',
            ], 401);
        } else {
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Forbidden Unauthorized.',
                ], 401);
            } else {
                return response()->json([
                    'message' => 'Login Success.',
                    'user' => ['username' => $user->username],
                    'data' => json_decode((string)$this->getToken(), true),
                ], 200);
            }
        }
    }

    //获得token
    public function getToken()
    {
        //密码授权模式，获取令牌 过期时间 刷新令牌
        $response = $this->http->post(env('PASS_PORT_URL'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'username' => request('username'),
                'password' => request('password'),
                'scope' => '*',
                'provider' => 'admin_admins'
            ],
        ]);
        return $response->getBody();
    }
}
