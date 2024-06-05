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
        Schema::create('tallers', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_taller');
            $table->time('ingreso');
            $table->time('salida')->nullable();
            $table->date('fecha_ingreso');
            $table->date('fecha_salida')->nullable();
            $table->string('conductor',255);
            $table->string('vehiculo',255);
            $table->string('color',255)->nullable();
            $table->string('dependencia',255);
            $table->string('placa',255);
            $table->string('kilometraje',255);
            $table->string('ordentrabajo',255)->nullable();
            $table->string('responsable', 255);
            $table->unsignedBigInteger('vehiculo_id');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->string('clase',255);
            $table->string('tipo_vehiculo',255);
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
        Schema::dropIfExists('tallers');
    }
};
