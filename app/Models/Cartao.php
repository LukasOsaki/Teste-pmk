<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    use HasFactory;
    protected $table = 'cartoes';
    protected $fillable = [
        'primeiros_digitos',
        'ultimos_digitos',
        'bandeira',
        'cadastro_id',
    ];
}
