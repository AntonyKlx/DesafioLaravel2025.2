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
        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nome');
            $table->decimal('preco', 8, 2);
            $table->text('descricao');
            $table->integer('quantidade');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id_categoria')->on('categoria');
            $table->foreignId('anunciante_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto');
    }
};
