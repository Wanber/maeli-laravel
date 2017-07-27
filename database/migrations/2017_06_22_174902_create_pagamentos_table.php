<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venda_id')->unsigned()->nullable();
            $table->integer('consorcio_id')->unsigned()->nullable();
            $table->enum('forma', ['avista', 'cartao', 'cheque', 'promissoria', 'deposito', 'saldo']);
            $table->string('valor', 8);
            $table->string('observacao', 400)->nullable();
            $table->timestamp('data')->nullable();
            $table->boolean('recebido');
            $table->timestamps();

            $table->foreign('venda_id')->references('id')->on('vendas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('consorcio_id')->references('id')->on('consorcios')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}
