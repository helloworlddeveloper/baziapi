<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PasswordReset
 *
 * @property string $email
 * @property string $token
 * @property string|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereToken($value)
 * @mixin \Eloquent
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereId($value)
 */
class PasswordReset extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [];

    public $timestamps = false;

    public $incrementing = false;
}
