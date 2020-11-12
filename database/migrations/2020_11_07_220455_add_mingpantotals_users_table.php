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
            $table->string('bak1')->nullable();
            $table->string('bak2')->nullable();
            $table->string('bak3')->nullable();
            $table->string('bak4')->nullable();
            $table->string('bak5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'mingpantotal',
                'bak1',
                'bak2',
                'bak3',
                'bak4',
                'bak5',
            ]);
        });
    }
}
