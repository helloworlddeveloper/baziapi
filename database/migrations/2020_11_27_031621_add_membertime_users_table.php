<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMembertimeUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('membertime')->nullable();
            $table->dateTime('time2')->nullable();
            $table->dateTime('time3')->nullable();
            $table->text('text1')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
