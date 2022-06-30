@extends('template.layout')

@section('title', 'Cadastro de Produto')

@section('form-tittle', 'Cadastro de Produto')
@section('form')
    <form id="produtoForm" class="form-horizontal" role="form" method="POST" action="{{ route('produto.create') }}">
        @csrf
        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                maxlength="80" value="{{ old('nome') }}" autocomplete="nome" placeholder="Digite o nome do produto">
        </div>

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="preco">Preço:</label>
            <input type="number" name="preco" id="preco" class="form-control @error('preco') is-invalid @enderror"
                autocomplete="preco" value="{{ old('preco') }}" placeholder="Digite o preço">
        </div>

        <div style="margin-top:10px;">
            <a id="btn-danger" href="{{ route('menu') }}" class="btn btn-danger">Voltar</a>
            <button id="btn-add" type="submit" class="btn btn-success" style="float: right;">Adicionar</button>
        </div>
    </form>

    <h3 style="margin-top: 50px; text-align: center;">Listagem</h3>
    <table class="table table-striped" style="margin-top: 50px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->preco }}</td>
                    <td>
                        <a href="{{ route('produto.edit', $produto->id) }}" class="btn btn-info"><span
                                class="glyphicon glyphicon-pencil"></span></a>
                    </td>
                    <td>
                        <form action="{{ route('produto.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $produto->id }}">
                            <button type="submit" class="btn btn-danger"><span
                                    class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
