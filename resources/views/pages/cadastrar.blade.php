@extends('layouts.app')

@section('title', 'Cadastrar')

@section('content')
<div class="card-header d-flex align-items-center justify-content-between">
    <h3>Cadastrar</h3>
</div>
<div class="card-body">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul  style="list-style: none">
            <h4>Ocorreu um erro</h4>
            @foreach ($errors->all() as $error)
                <li style="color:#fff; font-size 20px">{{ $error }}</li>
            @endforeach
            <li></li>
        </ul>
    </div>
        
    @endif
    <form action="{{ route('cadastro.create') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome </label>
            <input required type="text" value="{{old('nome')}}" class="form-control" id="nome" name="nome" placeholder="Nome">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email </label>
            <input required type="email" value="{{old('email')}}" class="form-control email" id="email" name="email"
                placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF </label>
            <input required type="text" value="{{old('cpf')}}" class="form-control cpf" id="cpf" name="cpf"
                placeholder="000.000.000-00" data-inputmask="'mask': '999.999.999-99'">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone </label>
            <input required type="text" value="{{old('telefone')}}" class="form-control telefone" id="telefone" name="telefone"
                placeholder="(00)0000-00000" data-inputmask="'mask': '(99) 9999-9999[9]'">
        </div>
        <div class="mb-3">
            <label for="data_nascimento"  class="form-label">Data de nascimento </label>
            <input required type="date" value="{{old('data_nascimento')}}" class="form-control" id="data_nascimento" name="data_nascimento">
        </div>
        <div class="mb-3">
            <label for="intervalo_doacao" class="form-label">Intervalo de Doação </label>
            <select class="form-select" value="{{old('intervalo_doacao')}}" id="intervalo_doacao" name="intervalo_doacao"
                aria-label="Default select example">
                <option selected value="Único">Único</option>
                <option value="Bimestral">Bimestral</option>
                <option value="Semestral">Semestral</option>
                <option value="Anual">Anual</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="valor_doacao" class="form-label">Valor da Doação </label>
            <input required type="text" value="{{old('valor_doacao')}}" required class="form-control valor" id="valor_doacao" name="valor_doacao"
                placeholder="0.00" data-inputmask="'mask': '9{0,}[.9{2}]'">
        </div>
        <div class="mb-3">
            <label for="forma_pagamento" class="form-label">Forma de pagamento </label>
            <select class="form-select" value="{{old('forma_pagamento')}}" id="forma_pagamento" name="forma_pagamento"
                aria-label="Default select example">
                <option {{old('forma_pagamento') == "Débito" ? 'selected' : '' }} value="Débito">Débito</option>
                <option {{old('forma_pagamento') == "Crédito" ? 'selected' : '' }}  value="Crédito">Crédito</option>
                
            </select>
        </div>
        <!-- Campos adicionais para a opção "Crédito" -->
        <div id="campos_credito">
            <label for="bandeira">Bandeira do cartão</label>
            <input type="text" value="{{old('bandeira')}}" name="bandeira" class="form-control" id="bandeira" placeholder="Bandeira do cartão">

            <label for="primeiros_digitos">6 primeiros dígitos</label>
            <input type="text" value="{{old('primeiros_digitos')}}" class="form-control conta" placeholder="000000" name="primeiros_digitos" id="primeiros_digitos"
            data-inputmask="'mask': '999999'">

            <label for="ultimos_digitos">4 últimos dígitos</label>
            <input type="text" value="{{old('ultimos_digitos')}}" class="form-control agencia" name="ultimos_digitos" id="ultimos_digitos"
            data-inputmask="'mask': '9999'" placeholder="0000">

        </div>

        <!-- Campos adicionais para a opção "Débito" -->
        <div id="campos_debito">
            <label for="agencia">Agência</label>
            <input type="text" value="{{old('agencia')}}" class="form-control agencia" name="agencia" id="agencia" placeholder="0000" 
            data-inputmask="'mask': '9999'">

            <label for="conta">Conta</label>
            <input type="text" value="{{old('conta')}}" class="form-control conta" name="conta" id="conta" placeholder="000000" 
            data-inputmask="'mask': '999999'">

            <label for="banco">Banco</label>
            <input type="text" value="{{old('banco')}}" class="form-control" name="banco" id="banco" placeholder="Banco">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereco </label>
            <input required value="{{old('endereco')}}" type="text" required class="form-control" id="endereco" name="endereco"
                >
        </div>
        <div class="mb-3">
            <button class="btn btn-success">Cadastrar</button>
        </div>
        <br>
    </form>
</div>
@endsection

@section('js')
     {{-- mascaras --}}
     <script>
        $(function() {
            $('.valor').inputmask();
        });
        $(document).ready(function() {
            $('.email').mask('A', {
                translation: {
                    'A': {
                        pattern: /[\w@\-.+]/,
                        recursive: true
                    }
                }
            });
        });
        $(function() {
            $('.cpf').inputmask();
        });
        $(function() {
            $('.telefone').inputmask();
        });
        $(function() {
            $('.conta').inputmask();
        });
        $(function() {
            $('.agencia').inputmask();
        });
    </script>
    {{-- Forma de pagamento --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectElement = document.getElementById('forma_pagamento');
            var camposCredito = document.getElementById('campos_credito');
            var camposDebito = document.getElementById('campos_debito');

            // Oculta os campos adicionais inicialmente
            if (selectElement.value === 'Crédito') {
                camposDebito.style.display = 'none';

            } else {
                camposCredito.style.display = 'none';

            }

            // Adiciona um evento de mudança ao campo select
            selectElement.addEventListener('change', function() {
                if (selectElement.value === 'Crédito') {
                    camposCredito.style.display = 'block';
                    camposDebito.style.display = 'none';
                } else if (selectElement.value === 'Débito') {
                    camposCredito.style.display = 'none';
                    camposDebito.style.display = 'block';
                } else {
                    camposCredito.style.display = 'none';
                    camposDebito.style.display = 'none';
                }
            });
        });
    </script>
@endsection

