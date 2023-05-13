<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;
    protected $table = 'contas';
    protected $fillable = [
        'agencia',
        'conta',
        'banco',
        'cadastro_id',
    ];
}
