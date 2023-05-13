<?php

namespace Database\Factories;

use App\Models\Cadastro;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


class CadastroFactory extends Factory
{
    protected $model = Cadastro::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'cpf' => $this->faker->unique()->cpf,
            'telefone' => $this->faker->phoneNumber,
            'data_nascimento' => $this->faker->date,
            'valor_doacao' => $this->faker->randomFloat(2, 10, 100),
            'intervalo_doacao' => $this->faker->randomElement(['Único', 'Bimestral', 'Semestral', 'Anual']),
            'forma_pagamento' => $this->faker->randomElement(['Débito', 'Crédito']),
            'endereco' => $this->faker->address,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Cadastro $cadastro) {
            if ($cadastro->forma_pagamento === 'Débito') {
                $cadastro->conta()->create([
                    'agencia' => $this->faker->randomNumber(4),
                    'conta' => $this->faker->randomNumber(6),
                    'banco' => $this->faker->company,
                ]);
            } else if ($cadastro->forma_pagamento === 'Crédito') {
                $cadastro->cartao()->create([
                    'primeiros_digitos' => $this->faker->randomNumber(6),
                    'ultimos_digitos' => $this->faker->randomNumber(4),
                    'bandeira' => $this->faker->creditCardType,
                ]);
            }
        });
    }
}