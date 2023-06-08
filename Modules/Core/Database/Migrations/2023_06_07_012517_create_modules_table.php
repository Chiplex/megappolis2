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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_id');
            $table->string('controller', 200)->nullable();
            $table->string('action', 200)->nullable();
            $table->string('name', 200);
            $table->string('description', 255)->nullable();
            $table->string('type', 20);
            $table->string('icon')->nullable();
            $table->foreignId('module_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
};
