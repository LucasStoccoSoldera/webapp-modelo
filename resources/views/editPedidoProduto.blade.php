@extends('template.layout')

@section('title', 'Atualizar Pedido Produto')

@section('form-tittle', 'Atualizar Pedido Produto')
@section('form')
    <form id="pedidoprodutoForm" name="pedidoprodutoForm" class="form-horizontal" role="form" method="POST"
        action="{{ route('pedidoproduto.update') }}">
        @csrf
        @method('PUT')

        <input type="text" name="pedido" value="{{ $pedidoProduto[0]->id_pedido }}" hidden>
        <label for="pedido">Pedido:</label>
        <label for="pedido" style="color: orangered;">{{ $pedidoProduto[0]->id_pedido }}</label>
        <br>
        <input type="text" name="produto" value="{{ $pedidoProduto[0]->id_produto }}" hidden>
        <label for="pedido">Pedido:</label>
        <label for="pedido" style="color: orangered;">{{ $pedidoProduto[0]->id_produto }} -
            {{ $pedidoProduto[0]->nome }}</label>


        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="qtde">Quantidade:</label>
            <input type="number" name="qtde" id="qtde" class="form-control @error('qtde') is-invalid @enderror"
                autocomplete="qtde" value="{{ $pedidoProduto[0]->qtde }}" placeholder="Digite a quantidade">
        </div>


        <div style="margin-top:10px;">
            <a id="btn-danger" href="{{ route('pedido') }}" class="btn btn-danger">Voltar</a>
            <button id="btn-add" type="submit" class="btn btn-success" style="float: right;">Atualizar</button>
        </div>
    </form>
@endsection
