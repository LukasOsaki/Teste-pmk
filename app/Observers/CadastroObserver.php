<?php

namespace App\Observers;

use App\Models\Cadastro as Cadastro;
use Illuminate\Support\Facades\Log;

class CadastroObserver
{
    //
    public function created(Cadastro $modelo)
    {
        Log::info('Novo cadastro realizado', ['dados' => $modelo->toArray()]);
    }
}
