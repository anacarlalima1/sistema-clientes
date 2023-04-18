<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEsqueceuSenha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('esqueceu_senha')) {
            Schema::create('esqueceu_senha', function (Blueprint $table) {
                $table->id();
                $table->integer('id_user')->unsigned();
                $table->string('codigo');
                $table->boolean('utilizado');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('esqueceu_senha');
    }
}
