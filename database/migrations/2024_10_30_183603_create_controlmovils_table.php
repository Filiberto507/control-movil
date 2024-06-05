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
        Schema::create('controlmovils', function (Blueprint $table) {
            $table->id();
            $table->string('vehiculo', 255);
            $table->string('placa', 255);
            $table->string('dependencia', 255);
            $table->string('mes', 255)->nullable();;
            $table->string('conductor', 255);
            $table->time('hora_salida');
            $table->time('hora_retorno')->nullable();;
            $table->date('fecha')->nullable();;
            $table->string('km_salida', 255);
            $table->string('km_regreso', 255)->nullable();;
            $table->integer ('combustible')->nullable();;
            $table->longText('tipo_destino')->nullable();
            $table->longText('firma')->nullable();
            $table->unsignedBigInteger('vehiculo_id');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
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
        Schema::dropIfExists('controlmovils');
    }
};
