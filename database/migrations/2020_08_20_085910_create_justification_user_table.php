<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJustificationUserTable extends Migration
{

    public function up()
    {
        Schema::create('justification_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('justification_id');
            $table->foreign('justification_id')->references('id')->on('justifications');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('justification_user');
    }
}
