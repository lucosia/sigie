<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 200);
            $table->string('cnpj', 14)->unique();
            $table->boolean('status')->default(1);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('instituicao_id')->nullable()->after('remember_token');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_instituicao_id_foreign');
            $table->dropColumn('instituicao_id');
        });
        Schema::dropIfExists('instituicao');
    }
}
