<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivityToUserTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('activity_token')->comment('激活验证token');
            $table->dateTime('activity_expire', 0)->nullable()->comment('激活过期时间');
            $table->integer('is_activity')->default(0)->comment('是否激活1是，0否');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('activity_token', 'activity_expire', 'is_activity');
        });
    }
}
