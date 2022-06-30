@extends('template.layout')

@section('title', 'Atualizar Produto')

@section('form-tittle', 'Atualizar Produto')
@section('form')
    <form id="produtoForm" name="produtoForm" class="form-horizontal" role="form" method="POST"
        action="{{ route('produto.update') }}">
        @csrf
        @method('PUT')

        <input type="text" name="id" value="{{ $produto->id }}" hidden>
        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                maxlength="80" value="{{ $produto->nome }}" autocomplete="nome" placeholder="Digite o nome do produto">
        </div>

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="preco">Preço:</label>
            <input type="number" name="preco" id="preco" class="form-control @error('preco') is-invalid @enderror"
                autocomplete="preco" value="{{ $produto->preco }}" placeholder="Digite o preço">
        </div>

        <div style="margin-top:10px;">
            <a id="btn-danger" href="{{ route('produto') }}" class="btn btn-danger">Voltar</a>
            <button id="btn-add" type="submit" class="btn btn-success" style="float: right;">Atualizar</button>
        </div>
    </form>
@endsection
