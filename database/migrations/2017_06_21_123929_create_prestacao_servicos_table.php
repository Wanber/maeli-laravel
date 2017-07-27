<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestacaoServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestacao_servicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parceiro_id')->unsigned();
            $table->integer('servico_id')->unsigned();

            $table->foreign('parceiro_id')
                ->references('id')
                ->on('parceiros');

            $table->foreign('servico_id')
                ->references('id')
                ->on('servicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestacao_servicos');
    }
}
