<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->id();
            $table->string('routers')->nullable();
            $table->text('title')->nullable();
            $table->text('desc')->nullable();
            $table->text('content')->nullable();
            $table->text('sys_1')->nullable();
            $table->text('sys_2')->nullable();
            $table->text('sys_3')->nullable();
            $table->text('sys_4')->nullable();
            $table->text('sys_5')->nullable();
            $table->text('sys_6')->nullable();
            $table->text('sys_7')->nullable();
            $table->text('sys_8')->nullable();
            $table->text('sys_9')->nullable();
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
        Schema::dropIfExists('systems');
    }
}
