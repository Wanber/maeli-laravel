<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacotes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 80);
            $table->string('descricao', 400);
            $table->string('valor', 8);
            $table->string('vagas', 3);
            $table->timestamp('dt_partida')->nullable();
            $table->timestamp('dt_retorno')->nullable();
            $table->string('local_embarque', 50);
            $table->string('destino', 80);
            $table->timestamps();
        });

        Schema::create('servicos_inclusos', function (Blueprint $table) {
            $table->integer('prestacao_servico_id')->unsigned();
            $table->integer('pacote_id')->unsigned();
            $table->string('preco', 6);
            $table->string('descricao', 400);

            $table->foreign('prestacao_servico_id')->references('id')->on('prestacao_servicos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pacote_id')->references('id')->on('pacotes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['prestacao_servico_id', 'pacote_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicos_inclusos');
        Schema::dropIfExists('pacotes');
    }
}
