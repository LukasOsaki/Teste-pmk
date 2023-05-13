<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cadastro;
use App\Models\Cartao;
use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CadastroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data["cadastros"] = Cadastro::all();
        return view('pages/home', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|email',
            'cpf' => 'required|unique:cadastros',
            'telefone' => 'required',
            'data_nascimento' => 'required',
            'intervalo_doacao' => 'required',
            'valor_doacao' => 'required',
            'forma_pagamento' => 'required',
            'endereco' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('cadastrar')->withErrors($validator)->withInput();
        }
        $data = $request->only('nome', 'email', 'cpf', 'telefone','data_nascimento', 'intervalo_doacao', 'valor_doacao', 'forma_pagamento', 'endereco');
        if($request->forma_pagamento == "Crédito"){
            //Faz a consulta para verificar existencia do cartão
            $cartoes = Cartao::where([
                ['primeiros_digitos', '=', "$request->primeiros_digitos"],
                ['ultimos_digitos', '=', "$request->ultimos_digitos"],
            ])->get();
            if ($cartoes->isNotEmpty()) { // O cartão já existe
                $validator->errors()->add('cartao', "O Cartão já foi cadastrado ");
                return redirect()->route('cadastrar')->withErrors($validator)->withInput();
            } else {
                // O retorno da consulta é nulo
                $cadastro = Cadastro::create($data);
                $validator = Validator::make($request->all(), [
                    'bandeira' => 'required',
                    'primeiros_digitos' => 'required',
                    'ultimos_digitos' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->route('cadastrar')->withErrors($validator)->withInput();
                }
                $cartao = $request->only('bandeira', 'primeiros_digitos', 'ultimos_digitos');
                $cartao["cadastro_id"] = $cadastro->id;
                Cartao::create($cartao);
            }
        }else {
            $cadastro = Cadastro::create($data);
            $validator = Validator::make($request->all(), [
                'agencia' => 'required',
                'banco' => 'required',
                'conta' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('cadastrar')->withErrors($validator)->withInput();
            }
            $conta = $request->only('agencia', 'banco', 'conta');
            $conta["cadastro_id"] = $cadastro->id;
            Conta::create($conta);
        }
        return redirect(route('index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data['cadastro'] = Cadastro::find($id);
        return view('pages/cadastro', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //
        $cadastro = Cadastro::find($id);
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
            'data_nascimento' => 'required',
            'intervalo_doacao' => 'required',
            'valor_doacao' => 'required',
            'forma_pagamento' => 'required',
            'endereco' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('cadastrar')->withErrors($validator)->withInput();
        }
        $data = $request->only('nome', 'email', 'telefone','data_nascimento', 'intervalo_doacao', 'valor_doacao', 'forma_pagamento', 'endereco');
        if($request->forma_pagamento == "Crédito"){
            //Faz a consulta para verificar existencia do cartão
            $cartoes = Cartao::where([
                ['primeiros_digitos', '=', "$request->primeiros_digitos"],
                ['ultimos_digitos', '=', "$request->ultimos_digitos"],
                ['cadastro_id', '!=', "$cadastro->id"],
            ])->get();
            if ($cartoes->isNotEmpty()) { // O cartão já existe
                $validator->errors()->add('cartao', "O Cartão já foi cadastrado ");
                return redirect()->route('cadastros.edit', ['cadastro' => $cadastro->id])->withErrors($validator)->withInput();
            } else {
                // O retorno da consulta é nulo
                
                $validator = Validator::make($request->all(), [
                    'bandeira' => 'required',
                    'primeiros_digitos' => 'required',
                    'ultimos_digitos' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->route('cadastros.edit', ['cadastro' => $cadastro->id])->withErrors($validator)->withInput();
                }
                $cadastro->save();
                $cartao = Cartao::find($cadastro['cartao']->id);
                $cartao->bandeira = $request->bandeira;
                $cartao->primeiros_digitos = $request->primeiros_digitos;
                $cartao->ultimos_digitos = $request->ultimos_digitos;
                $cartao->save();
            }
        }else {
            
            $validator = Validator::make($request->all(), [
                'agencia' => 'required',
                'banco' => 'required',
                'conta' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('cadastros.edit', ['cadastro' => $cadastro->id])->withErrors($validator)->withInput();
            }
            $cadastro->save();
            $conta = Conta::find($cadastro['conta']->id);
            $conta->agencia = $request->agencia;
            $conta->banco = $request->banco;
            $conta->conta = $request->conta;
            $conta->save();
        }
        return redirect()->route('cadastros.edit', ['cadastro' => $cadastro->id])->withErrors($validator)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
          //
          dd("aqui");
          $cadastro = Cadastro::find($id);

          // Verifique se o usuário existe
          if ($cadastro) {
              // Exclua o usuário
              $cadastro->delete();
      
              // Retorne uma mensagem de sucesso ou redirecione para outra página
              return redirect()->route('index')->with('success', 'Cadastro excluído com sucesso!');
          }
      
          // Caso o usuário não exista, retorne uma mensagem de erro ou redirecione para outra página
          return redirect()->back()->with('error', 'Cadastro não encontrado!');
    }
    public function excluir(Request $request, string $id)
    {
      
    }

    public function cadastrar()
    {
        //
        return view('pages/cadastrar');
    }
}
