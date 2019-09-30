<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 200);
            $table->string('cpf', 11)->unique();
            $table->date('data_de_nascimento');
            $table->string('celular', 11);
            $table->string('endereco', 150);
            $table->string('numero', 10);
            $table->string('bairro', 100);
            $table->string('cidade', 100);
            $table->string('uf', 2);
            $table->unsignedBigInteger('instituicao_id');
            $table->boolean('status')->default(1);

            $table->foreign('instituicao_id')->references('id')->on('instituicao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aluno', function (Blueprint $table) {
            $table->dropForeign('aluno_instituicao_id_foreign');
        });
        Schema::dropIfExists('aluno');
    }
}
