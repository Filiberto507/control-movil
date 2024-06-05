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
        Schema::create('tallerdetalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('acctaller_id');
            $table->foreign('acctaller_id')->references('id')->on('accesoriostallers');
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
        Schema::dropIfExists('tallerdetalles');
    }
};
