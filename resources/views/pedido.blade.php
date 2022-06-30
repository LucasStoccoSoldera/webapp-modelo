@extends('template.layout')

@section('title', 'Cadastro de Pedido')

@section('form-tittle', 'Cadastro de Pedido')
@section('form')
    <h3 style="margin-top: 20px; text-align: center;">Pedido</h3>

    <form id="pedidoForm" class="form-horizontal" role="form" method="POST" action="{{ route('pedido.create') }}">
        @csrf

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="cliente">Cliente:</label>
            <select type="text" name="cliente" id="cliente" class="form-control" value="{{ old('cliente') }}"
                placeholder="Selecione o cliente">
                <option value="">------------Selecione------------</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-top:10px;">
            <a id="btn-danger" href="{{ route('menu') }}" class="btn btn-danger">Voltar</a>
            <button id="btn-add" type="submit" class="btn btn-success"
                style="float: right; margin-bottom: 30px;">Adicionar
                Pedido</button>
        </div>
    </form>

    <h4 style="margin-top: 50px; text-align: center;">Listagem</h4>
    <table class="table table-striped" style="margin-top: 50px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->id_cliente }}</td>
                    <td>{{ $pedido->preco }}</td>
                    <td>
                        <form action="{{ route('pedido.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $pedido->id }}">
                            <button type="submit" class="btn btn-danger"><span
                                    class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr style="margin-top: 50px;" />

    <h3 style="margin-top: 30px; text-align: center;">Pedido Produto</h3>

    <form id="pedidoProdutoForm" class="form-horizontal" role="form" method="POST"
        action="{{ route('pedidoproduto.create') }}">
        @csrf

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="pedido">Pedido:</label>
            <select type="text" name="pedido" id="pedido" class="form-control" value="{{ old('pedido') }}"
                placeholder="Selecione o pedido">
                <option value="">------------Selecione------------</option>
                @foreach ($pedidos as $pedido)
                    <option value="{{ $pedido->id }}">{{ $pedido->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="produto">Produto:</label>
            <select type="text" name="produto" id="produto" class="form-control" value="{{ old('produto') }}"
                placeholder="Selecione produto">
                <option value="">------------Selecione------------</option>
                @foreach ($produtos as $produto)
                    <option value="{{ $produto->id }}">{{ $produto->id }} - {{ $produto->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="qtde">Quantidade:</label>
            <input type="number" name="qtde" id="qtde" class="form-control @error('qtde') is-invalid @enderror"
                autocomplete="qtde" value="{{ old('qtde') }}" placeholder="Digite a quantidade">
        </div>


        <div style="margin-top:10px;">
            <a id="btn-danger" href="{{ route('menu') }}" class="btn btn-danger">Voltar</a>
            <button id="btn-add" type="submit" class="btn btn-success" style="float: right;">Adicionar Produto ao
                Pedido</button>
        </div>
    </form>

    <h4 style="margin-top: 50px; text-align: center;">Listagem</h4>
    <table class="table table-striped" style="margin-top: 50px;">
        <thead>
            <tr>
                <th>Pedido</th>
                <th>Produto</th>
                <th>Qtde.</th>
                                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidoProdutos as $pedidoProduto)
                <tr>
                    <td>{{ $pedidoProduto->id_pedido }}</td>
                    <td>{{ $pedidoProduto->id_produto }}</td>
                    <td>{{ $pedidoProduto->qtde }}</td>
                    <td>{{ $pedidoProduto->preco }}</td>
                    <td>
                        <a href="{{ route('pedidoproduto.edit', [$pedidoProduto->id_pedido, $pedidoProduto->id_produto]) }}"
                            class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                    </td>
                    <td>
                        <form action="{{ route('pedidoproduto.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="pedido" value="{{ $pedidoProduto->id_pedido }}">
                            <input type="hidden" name="produto" value="{{ $pedidoProduto->id_produto }}">
                            <button type="submit" class="btn btn-danger"><span
                                    class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
