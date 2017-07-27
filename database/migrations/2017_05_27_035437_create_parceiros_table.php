<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParceirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parceiros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 80);
            $table->string('cpf', 11)->unique()->nullable();
            $table->string('cnpj', 14)->unique()->nullable();
            $table->string('email', 80);
            $table->string('telefone', 11);
            $table->string('telefone2', 11)->nullable();
            $table->string('cidade', 60);
            $table->string('rua', 60);
            $table->string('bairro', 60);
            $table->string('cep', 8);
            $table->string('numero', 8);
            $table->string('complemento', 40)->nullable();

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
        Schema::dropIfExists('parceiros');
    }
}
