<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable1Table extends Migration
{
    public function up()
    {
        Schema::create('table_1', function (Blueprint $table) {
            $table->id();
            $table->string('column1');
            $table->string('column2');
            $table->string('column3');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('table_1');
    }
}
