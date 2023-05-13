<?php

namespace App\Console\Commands;

use App\Models\Cadastro;
use App\Models\Registro;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RegistroDiarioCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:registro-diario-command';
    protected $description = 'Contagem de debitos e creditos do dia anterior';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        // Obter a data do dia anterior
        $date = Carbon::yesterday();

        // Contar os registros de débito e crédito do dia anterior
        $debitCount = Cadastro::where('forma_pagamento', 'Débito')
            ->whereDate('created_at', $date)
            ->count();
        
        $creditCount = Cadastro::where('forma_pagamento', 'Crédito')
            ->whereDate('created_at', $date)
            ->count();
        
        // Salvar os registros na tabela daily_registration
        Registro::create([
            'date' => $date,
            'debitos' => $debitCount,
            'creditos' => $creditCount,
        ]);

        $this->info('Registros dos dias salvos com sucesso!');
    }
}
