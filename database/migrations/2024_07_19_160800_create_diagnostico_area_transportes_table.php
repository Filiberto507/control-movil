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
        Schema::create('diagnostico_area_transportes', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_diagtransporte');
            $table->date('fecha');
            $table->string('dependencia',255);
            $table->string('conductor',255);
            $table->string('conclusion',450);
            $table->integer('tipo_taller');
            $table->unsignedBigInteger('vehiculos_id');
            $table->foreign('vehiculos_id')->references('id')->on('vehiculos');
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
        Schema::dropIfExists('diagnostico_area_transportes');
    }
};
