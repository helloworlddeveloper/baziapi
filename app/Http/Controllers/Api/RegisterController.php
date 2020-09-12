<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use GuzzleHttp\Client as Guzzle;

class RegisterController extends Controller
{
    protected $clientId;
    protected $clientSecret;
    private $http;
    protected $url = 'http://data.com/oauth/token';

    public function __construct(Guzzle $http)
    {
        $client = \DB::table('oauth_clients')->where('id', 2)->first();
        $this->clientId = $client->id;
        $this->clientSecret = $client->secret;
        $this->http = $http;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->create($request->all());
        return response()->json([
            'message' => '注册成功',
            'data' => json_decode((string)$this->getToken(), true)
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)
            ->firstOr(function () {
                return false;
            });

        if ($user === false) {
            return response()->json([
                'message' => '账号或密码错误',
            ], 403);
        } else {
            if (!password_verify($request->password, $user->password)) {
                return response()->json([
                    'message' => '账号或密码错误',
                ], 403);
            }
//            dd(auth()->user());
            return response()->json([
                'message' => '登陆成功',
                'data' => json_decode((string)$this->getToken(), true),

            ]);
        }
    }

    public function logout()
    {
        $tokenModel = \Auth::user()->token();
        $tokenModel->update([
            'revoked' => 1,
        ]);
        \DB::table('oauth_refresh_tokens')
            ->where(['access_token_id' => $tokenModel->id])->update([
                'revoked' => 1,
            ]);
        return response()->json([
            'message' => '退出登陆成功',
        ]);

    }

    public function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
        return $user;
    }

    public function getToken()
    {
        $response = $this->http->post($this->url, [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'username' => request('email'),
                'password' => request('password'),
                'scope' => '*',
            ],
        ]);
        return $response->getBody();
    }
}
