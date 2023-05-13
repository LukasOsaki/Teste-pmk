<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cadastro extends Model
{
    use HasFactory;
    protected $table = 'cadastros';
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cpf',
        'data_nascimento',
        'intervalo_doacao',
        'valor_doacao',
        'forma_pagamento',
        'endereco',
    ];
    public function conta(){
        return $this->hasOne(Conta::class);
    }
    public function cartao(){
        return $this->hasOne(Cartao::class);
    }
}
