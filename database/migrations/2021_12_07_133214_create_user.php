<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user')) {
            Schema::create('user', function (Blueprint $table) {
                $table->id();
                $table->string('nome')->nullable();
                $table->string('email')->unique();
                $table->string('matricula')->unique()->nullable();
                $table->string('password');
                $table->integer('id_privilegio')->unsigned();
                $table->integer('id_turma')->unsigned()->nullable();
                $table->integer('id_escola')->unsigned()->nullable();
                $table->string('foto')->nullable();
                $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo');
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
        Schema::dropIfExists('user');
    }
}
