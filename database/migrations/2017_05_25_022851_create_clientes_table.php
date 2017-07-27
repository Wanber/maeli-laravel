<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 80);
            $table->string('cpf', 11)->unique();
            $table->string('rg', 12);
            $table->enum('sexo', ['m','f']);
            $table->timestamp('dt_nascimento');
            $table->enum('estado_civil', ['solteiro','casado','divorciado','viuvo','separado']);
            $table->string('email', 80);
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
        Schema::dropIfExists('clientes');
    }
}
