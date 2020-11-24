<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminReplyMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_reply_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('uid')->comment('回复的留言所属的用户ID');
            $table->integer('mid')->comment('该留言ID');
            $table->text('reply_message_content')->comment('回复留言的内容');
            $table->dateTime('reply_message_time')->nullable()->comment('回复留言时间');
            $table->integer('reply_is_revoke')->default(0)->comment('该回复是否已删除（显示与不显示，0为显示，1为隐藏，默认0');
            $table->integer('reply_is_read')->default(0)->comment('该回复是否已读（默认0未读，1为已读');
            $table->string('reply_bak_1')->nullable()->comment('备用字段1');
            $table->string('reply_bak_2')->nullable()->comment('备用字段2');
            $table->string('reply_bak_3')->nullable()->comment('备用字段3');
            $table->string('reply_bak_4')->nullable()->comment('备用字段4');
            $table->integer('reply_bak_5')->nullable()->comment('备用字段5');
            $table->integer('reply_bak_6')->nullable()->comment('备用字段6');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_reply_messages');
    }
}
