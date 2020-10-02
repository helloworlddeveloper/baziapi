<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use GuzzleHttp\Client as Guzzle;

class RegisterController extends Controller
{
    protected $clientId;
    protected $clientSecret;
    private $http;

    public function __construct(Guzzle $http)
    {
        //构造函数，取出客户端ID和secret，新建Http对象
        $client = \DB::table('oauth_clients')->where('id', 2)->first();
        $this->clientId = $client->id;
        $this->clientSecret = $client->secret;
        $this->http = $http;
    }

    public function username()
    {
        return 'email';
    }

    public function register(RegisterRequest $request)
    {
        //注册，插入数据
        $user = $this->create($request->all());

        //传给激活邮件试图的数据
        $mailData = array(
            'username' => $user->username,
            'time' => $user->activity_expire,
            'token' => $user->activity_token,
        );

        //发送激活邮件
        \Mail::to($user->email)->send(new UserMail($mailData));

        return response()->json([
            'message' => '注册成功，请前往注册邮箱激活账号。',
            'token' => json_decode((string)$this->getToken(), true),
            'mail' => [
                'activity_token' => $user->activity_token,
                'activity_expire' => $user->activity_expire,
                'mailInfo' => \Mail::failures()
            ]
        ], 200);
    }

    //激活账号
    public function activityMail(Request $request)
    {
        //通过传过来的token获取当前账号集合
        $user = User::where('activity_token', $request->activity_token)
            ->firstOr(function () {
                return false;
            });

        if ($user === false) {
            return redirect('https://bazi.water555.xyz/login?active=' . '非法操作');
        }

        //比对时间
        //$tomorrow = strtotime(date("Y-m-d H:m", strtotime("+ 1 day")));
        $contrasTime = strtotime($request->activity_expire) > time();

        if ($user && $contrasTime) {
            $user->is_activity = 1;
            $user->save();
            return redirect('https://bazi.water555.xyz/login?active=1');
        } else {
            //激活超期，直接删除。
            User::where(['activity_token' => $request->activity_token])->delete();
            return redirect('https://bazi.water555.xyz/login?active=' . '激活账号已经超期，请重新注册。');
        }
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)
            ->firstOr(function () {
                return false;
            });
        //匹配到用户，比对密码
        if (!password_verify($request->password, $user->password)) {
            return response()->json([
                'message' => '账号或密码错误',
            ], 403);
        }
        return response()->json([
            'message' => '登陆成功',
            'data' => json_decode((string)$this->getToken(), true),
        ], 200);
    }

    public function logout()
    {
        //退出登陆，删除令牌
        revoked();
        return response()->json([
            'message' => '退出登陆成功',
        ], 200);

    }

    public function refresh(Request $request)
    {
        //刷新令牌
        $response = $this->http->post(env('PASS_PORT_URL'), [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->input('refresh_token'),
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => '*',
            ],
        ]);
        return $response;
    }

    public function create(array $data)
    {
        //过期时间
        $tomorrow = date("Y-m-d H:m", strtotime("+ 1 day"));
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'activity_token' => \Str::random(60),
            'activity_expire' => $tomorrow,
        ]);
        return $user;
    }

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
            ],
        ]);
        return $response->getBody();
    }
}
