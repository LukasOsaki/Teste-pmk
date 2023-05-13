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
        Schema::create('cadastros', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("email");
            $table->string("cpf");
            $table->string("telefone");
            $table->date("data_nascimento");
            $table->decimal("valor_doacao");
            $table->enum('intervalo_doacao', ['Único', 'Bimestral', 'Semestral', 'Anual']);
            $table->enum('forma_pagamento', ['Débito', 'Crédito']);
            $table->string("endereco");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cadastros');
    }
};
