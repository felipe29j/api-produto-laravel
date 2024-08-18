<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_produto');
            $table->decimal('valor_produto', 8, 2);
            $table->unsignedBigInteger('cod_marca');
            $table->float('estoque');
            $table->unsignedBigInteger('cod_cidade');
            $table->foreign('cod_marca')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('cod_cidade')->references('id')->on('cidades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}

