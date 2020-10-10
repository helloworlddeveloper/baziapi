<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('用户ID 自增');
            $table->string('username')->unique()->comment('用户账号');
            $table->string('email')->unique()->comment('用户Email');
            $table->timestamp('email_verified_at')->nullable()->comment('邮箱确认');
            $table->string('password')->comment('用户密码');
            $table->string('head_logo')->nullable()->comment('用户logo');
            $table->string('avatar')->nullable()->comment('用户头像');
            $table->string('user_ip')->nullable()->comment('用户IP地址');
            $table->integer('user_type')->default(0)->comment('用户类型，默认0为订阅普通用户');
            $table->string('activity_token')->comment('激活验证token');
            $table->dateTime('activity_expire', 0)->nullable()->comment('激活过期时间');
            $table->integer('is_activity')->default(0)->comment('是否激活1是，0否');
            $table->string('storage_1')->nullable()->comment('备用字段1');
            $table->string('storage_2')->nullable()->comment('备用字段2');
            $table->string('storage_3')->nullable()->comment('备用字段3');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
