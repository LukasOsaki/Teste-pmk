@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="card-header d-flex align-items-center justify-content-between">
    <h3>Cadastros</h3>
    <a href="{{ route('cadastrar') }}" class="btn btn-success">Inserir Cadastro</a>

</div>
<div class="card-body">
    @if ($errors->any())
        <ul class="alert alert-error" style="list-style: none;">
            @foreach ($errors->all() as $error)
                <li style="color: red;font-size 20px">{{ $error }}</li>
            @endforeach
            <li></li>
        </ul>
    @endif
    <table class="table table-hover datatables">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>Intervalo de doação</th>
                <th>Forma de pagamento</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($cadastros as $cadastro)
                <tr>
                    <td>{{ $cadastro->id }}</td>
                    <td>{{ $cadastro->nome }}</td>
                    <td>{{ $cadastro->email }}</td>
                    <td>{{ $cadastro->cpf }}</td>
                    <td>{{ $cadastro->intervalo_doacao }}</td>
                    <td class="">{{ $cadastro->forma_pagamento }}</td>
                    <td>
                        <a href="{{ route('cadastros.edit', ['cadastro' => $cadastro->id]) }}"
                            class="btn btn-primary">Visualizar</a>
                       
                            {{-- <form class="d-inline" action="{{ route('usuarios.excluir', ['id' => $usuario->id]) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-danger">Excluir</a>
                            </form> --}}

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
