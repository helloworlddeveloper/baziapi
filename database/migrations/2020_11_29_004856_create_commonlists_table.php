<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commonlists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type')->nullable();
            $table->string('icon')->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->text('commonlist_1')->nullable();
            $table->text('commonlist_2')->nullable();
            $table->text('commonlist_3')->nullable();
            $table->text('commonlist_4')->nullable();
            $table->text('commonlist_5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commonlists');
    }
}
