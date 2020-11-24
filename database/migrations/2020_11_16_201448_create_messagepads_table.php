<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagepadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messagepads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('uid')->comment('留言用户的ID');
            $table->text('message_content')->comment('留言的内容');
            $table->dateTime('message_time')->nullable()->comment('留言时间');
            $table->integer('is_read')->default(0)->comment('该留言是否已读，0为未读，1为已读，默认0');
            $table->integer('is_revoke')->default(0)->comment('该留言是否已删除（显示与不显示，0为显示，1为隐藏，默认0）');
            $table->integer('is_reply')->default(0)->comment('该留言是否被回复（默认0为未回复，1为回复）');
            $table->string('message_bak_1')->nullable()->comment('备用字段1');
            $table->string('message_bak_2')->nullable()->comment('备用字段2');
            $table->string('message_bak_3')->nullable()->comment('备用字段3');
            $table->string('message_bak_4')->nullable()->comment('备用字段4');
            $table->integer('message_bak_5')->nullable()->comment('备用字段5');
            $table->integer('message_bak_6')->nullable()->comment('备用字段6');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messagepads');
    }
}
