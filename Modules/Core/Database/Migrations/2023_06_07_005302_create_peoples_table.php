<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20);
            $table->string('name', 100);
            $table->string('otherName', 100);
            $table->string('lastName', 100);
            $table->string('otherLastName', 100);
            $table->date('birth');
            $table->string('sex', 20);
            $table->string('country', 100);
            $table->string('city', 100);
            $table->string('address', 100);
            $table->string('phone', 100);
            $table->integer('document')->unique()->unsigned();


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
        Schema::dropIfExists('peoples');
    }
};
