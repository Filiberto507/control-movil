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
        Schema::create('trabajo_realizadonts', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_trabajo');
            $table->string('vehiculo', 255);
            $table->string('placa', 255);
            $table->string('dependencia', 255);
            $table->string('responsable', 255);
            $table->string('km_ingreso', 255)->nullable();
            $table->string('km_salida', 255)->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->longText('descripcion')->nullable();
            $table->longText('observaciones')->nullable();
            $table->unsignedBigInteger('diagnosticont_id');
            $table->foreign('diagnosticont_id')->references('id')->on('diagnosticonts');
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
        Schema::dropIfExists('trabajo_realizadonts');
    }
};
