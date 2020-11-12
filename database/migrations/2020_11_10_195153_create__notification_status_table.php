<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_notification_status', function (Blueprint $table) {
            $table->id();
            $table->integer('not_uid')->nullable();
            $table->integer('not_id');
            $table->string('not_isread');
            $table->string('not_bak_1')->nullable();
            $table->string('not_bak_2')->nullable();
            $table->string('not_bak_3')->nullable();
            $table->string('not_bak_4')->nullable();
            $table->string('not_bak_5')->nullable();
            $table->string('not_bak_6')->nullable();
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
        Schema::dropIfExists('_notification_status');
    }
}
