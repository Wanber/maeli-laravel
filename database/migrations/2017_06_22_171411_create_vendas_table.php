<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valor', 8);
            $table->timestamps();
        });

        Schema::create('passageiros', function (Blueprint $table) {
            $table->integer('venda_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->boolean('responsavel');

            $table->foreign('venda_id')->references('id')->on('vendas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['venda_id', 'cliente_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passageiros');
        Schema::dropIfExists('vendas');
    }
}
