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
        Schema::create('diagnostico_obras', function (Blueprint $table) {
            $table->id();
            $table->integer('item');
            $table->integer('cantidad');
            $table->string('servicio',255);
            $table->unsignedBigInteger('diagnostico_area_transportes_id');
            $table->foreign('diagnostico_area_transportes_id')->references('id')->on('diagnostico_area_transportes');
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
        Schema::dropIfExists('diagnostico_obras');
    }
};
