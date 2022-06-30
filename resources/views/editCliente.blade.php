@extends('template.layout')

@section('title', 'Atualizar Cliente')

@section('form-tittle', 'Atualizar Cliente')
@section('form')
    <form id="clienteForm" name="clienteForm" class="form-horizontal" role="form" method="POST"
        action="{{ route('cliente.update') }}">
        @csrf
        @method('PUT')

        <input type="text" name="id" value="{{ $cliente->id }}" hidden>
        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="nome">Nome Completo:</label>
            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                maxlength="80" value="{{ $cliente->nome }}" autocomplete="nome" placeholder="Digite o nome completo">
        </div>

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="dtnasc">Data Nascimento:</label>
            <input type="date" name="dtnasc" id="dtnasc" class="form-control @error('dtnasc') is-invalid @enderror"
                value="{{ $cliente->data_nascimento->format('Y-m-d') }}" placeholder="Digite a Data de Nascimento">
        </div>

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="telefone">Telefone:</label>
            <input type="number" name="telefone" id="telefone"
                class="form-control @error('telefone') is-invalid @enderror" autocomplete="telefone" maxlength="14"
                value="{{ $cliente->telefone }}" placeholder="Digite o Telefone">
        </div>

        <div style="margin-top:10px;">
            <a id="btn-danger" href="{{ route('cliente') }}" class="btn btn-danger">Voltar</a>
            <button id="btn-add" type="submit" class="btn btn-success" style="float: right;">Atualizar</button>
        </div>
    </form>
@endsection
