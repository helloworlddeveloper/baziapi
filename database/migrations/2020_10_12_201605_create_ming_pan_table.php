<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMingPanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ming_pan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('账号对应的命盘');
            $table->string('year')->nullable()->comment('年');
            $table->string('month')->nullable()->comment('月');
            $table->string('day')->nullable()->comment('日');
            $table->string('hour')->nullable()->comment('小时');
            $table->string('minute')->nullable()->comment('分钟');
            $table->string('sex')->nullable()->comment('性别');
            $table->string('name')->nullable()->comment('姓名');
            $table->string('call')->nullable()->comment('称呼');
            $table->string('born')->nullable()->comment('出生地');
            $table->string('area')->nullable()->comment('常住区域');
            $table->string('type')->nullable()->comment('命盘特征');
            $table->string('desc')->nullable()->comment('描述');
            $table->string('bak1')->nullable()->comment('备用字段1');
            $table->string('bak2')->nullable()->comment('备用字段2');
            $table->string('bak3')->nullable()->comment('备用字段3');
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
        Schema::dropIfExists('ming_pan');
    }
}
