<?php

use App\Models\Cadastro;
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
        Schema::create('cartoes', function (Blueprint $table) {
            $table->id();
            $table->integer("primeiros_digitos")->digits(6);
            $table->integer("ultimos_digitos")->digits(4);
            $table->string("bandeira");
            $table->foreignIdFor(Cadastro::class)->references('id')->on('cadastros')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartoes');
    }
};
