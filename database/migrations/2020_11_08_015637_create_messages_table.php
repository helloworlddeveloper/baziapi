<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('uid')->nullable()->comment('用户ID');
            $table->string('usertype')->nullable()->comment('用户类型');

            $table->string('title')->nullable()->comment('信息标题');
            $table->string('message')->nullable()->comment('信息内容');

            $table->string('message_type')->nullable()->comment('信息类型');
            $table->string('isread')->nullable()->comment('阅读状态');
            $table->string('isrevoke')->nullable()->comment('是否删除 撤销');

            $table->dateTime('sendtime')->nullable()->comment('发送时间');
            $table->dateTime('readtime')->nullable()->comment('阅读时间');
            $table->dateTime('revoketime')->nullable()->comment('撤销时间');

            $table->string('bak_1')->nullable();
            $table->string('bak_2')->nullable();
            $table->string('bak_3')->nullable();
            $table->string('bak_4')->nullable();
            $table->string('bak_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
