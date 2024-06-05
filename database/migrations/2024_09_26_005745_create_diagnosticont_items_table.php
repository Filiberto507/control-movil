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
        Schema::create('diagnosticont_items', function (Blueprint $table) {
            $table->id();
            $table->integer('item');
            $table->string('descripcion',255);
            $table->unsignedBigInteger('diagnosticosnt_id');
            $table->foreign('diagnosticosnt_id')->references('id')->on('diagnosticonts');
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
        Schema::dropIfExists('diagnosticont_items');
    }
};
