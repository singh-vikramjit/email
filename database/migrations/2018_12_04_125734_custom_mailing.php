<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomMailing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_mailing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255);    
            $table->string('subject', 255);    
            $table->text('data');    
            $table->tinyInteger('status');    
            $table->timestamp('send_at');    
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
        //
    }
}
