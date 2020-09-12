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
            $table->string('logo')->nullable()->comment('用户logo');
            $table->string('photo')->nullable()->comment('用户头像');
            $table->string('ip')->nullable()->comment('用户IP地址');
            $table->integer('user_type')->default(0)->comment('用户类型');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
