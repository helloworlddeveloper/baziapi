<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMingpantotalsUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mingpantotal')->nullable();
            $table->string('bak_1')->nullable();
            $table->string('bak_2')->nullable();
            $table->string('bak_3')->nullable()->comment('订阅已到期');
            $table->string('bak_4')->nullable()->comment('是否首次登陆，0为从来没有登陆过');
            $table->string('bak_5')->default(0)->comment('记录底部版权隐藏状态，0默认隐藏，1显示');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
