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
        Schema::create('trabajo_realizado_tallers', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_trabajo');
            $table->string('vehiculo', 255);
            $table->string('placa', 255);
            $table->string('dependencia', 255);
            $table->string('responsable', 255);
            $table->string('km_ingreso', 255);
            $table->string('km_salida', 255);
            $table->date('fecha_ingreso');
            $table->date('fecha_salida');
            $table->longText('descripcion')->nullable();
            $table->longText('observaciones')->nullable();
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
        Schema::dropIfExists('trabajo_realizado_tallers');
    }
};
