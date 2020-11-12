<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AdminAuth;

/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUsername($value)
 * @mixin \Eloquent
 */
class Admin extends AdminAuth
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded = [];

    protected $hidden = [];

    public $timestamps = false;

    //passport替代email
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }
}
