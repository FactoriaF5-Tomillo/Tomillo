<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJustificationsTable extends Migration
{

    public function up()
    {
        Schema::create('justifications', function (Blueprint $table) {
            $table->id();
            $table->mediumText('file')->nullable();
            $table->text('title');
            $table->text('description');
            $table->boolean('approval')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('justifications');
    }
}
