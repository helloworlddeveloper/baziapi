<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use DateTimeInterface;

/**
 * App\Models\User
 *
 * @property int $id 用户ID 自增
 * @property string $username 用户账号
 * @property string $email 用户Email
 * @property \Illuminate\Support\Carbon|null $email_verified_at 邮箱确认
 * @property string $password
 * @property string|null $logo 用户logo
 * @property string|null $photo 用户头像
 * @property string|null $ip 用户IP地址
 * @property int $user_type 用户类型
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @property string $activity_token 激活验证token
 * @property string|null $activity_expire 激活过期时间
 * @property int $is_activity 是否激活1是，0否
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActivityExpire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActivityToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActivity($value)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //passport替代email
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i');
    }
}
