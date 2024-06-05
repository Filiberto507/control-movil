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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->char('placa',9)->nullable();
            $table->string('clase',45)->nullable();
            $table->string('marca',45)->nullable();
            $table->string('tipo_vehiculo',45)->nullable();
            $table->string('color',45)->nullable();
            $table->string('combustible_capacidad',45)->nullable();
            $table->string('motor',45)->nullable();
            $table->string('chasis',45)->nullable();
            $table->string('modelo',45)->nullable();
            $table->string('cilindrada',45)->nullable();
            $table->string('estado',45)->nullable();
            //$table->unsignedBigInteger('conductors_id');
           //$table->foreign('conductors_id')->references('id')->on('conductors');
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
        Schema::dropIfExists('vehiculos');
    }
};
