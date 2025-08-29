<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adm', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('senha');
            $table->string('nome');
            $table->string('logradouro');
            $table->string('cep', 8);
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado', 2);
            $table->string('telefone', 15);
            $table->date('data_de_nascimento');
            $table->string('cpf', 11);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm');
    }
};
