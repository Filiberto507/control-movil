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
        Schema::create('diagnostico_items', function (Blueprint $table) {
            $table->id();
            $table->integer('item');
            $table->string('descripcion',255);
            $table->unsignedBigInteger('diagnosticos_id');
            $table->foreign('diagnosticos_id')->references('id')->on('diagnosticos');
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
        Schema::dropIfExists('diagnostico_items');
    }
};
