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
        Schema::create('diagnosticonts', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_diagnostico');
            $table->date('fecha');
            $table->string('dependencia',255);
            $table->string('conductor',255);
            $table->integer('tipo_taller');
            $table->string('observacion',455)->nullable();
            $table->string('responsable', 255);
            $table->unsignedBigInteger('vehiculos_id');
            $table->foreign('vehiculos_id')->references('id')->on('vehiculos');
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
        Schema::dropIfExists('diagnosticonts');
    }
};
