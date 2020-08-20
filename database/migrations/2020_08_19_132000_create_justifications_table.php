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
            $table->string('file');
            $table->text('description');
            $table->boolean('approval');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('justifications');
    }
}
