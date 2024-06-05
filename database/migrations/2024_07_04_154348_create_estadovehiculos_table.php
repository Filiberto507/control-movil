<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadovehiculos', function (Blueprint $table) {
            $table->id();
            $table->longText('descripcion');
            $table->integer('key');
            $table->unsignedBigInteger('taller_id');
            $table->foreign('taller_id')->references('id')->on('tallers');
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
        Schema::dropIfExists('estadovehiculos');
    }
};