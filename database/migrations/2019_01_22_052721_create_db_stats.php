<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('db_id');
            $table->string('query');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('time_taken');
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
        Schema::dropIfExists('db_stats');
    }
}
