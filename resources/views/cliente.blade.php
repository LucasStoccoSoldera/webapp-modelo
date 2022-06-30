@extends('template.layout')

@section('title', 'Cadastro de Cliente')

@section('form-tittle', 'Cadastro de Cliente')
@section('form')
    <form id="clienteform" class="form-horizontal" role="form" method="POST" action="{{ route('cliente.create') }}">
        @csrf
        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="nome">Nome Completo:</label>
            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                maxlength="80" value="{{ old('nome') }}" autocomplete="nome" placeholder="Digite o nome completo">
        </div>

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="dtnasc">Data Nascimento:</label>
            <input type="date" name="dtnasc" id="dtnasc" class="form-control @error('dtnasc') is-invalid @enderror"
                autocomplete="dtnasc" value="{{ old('dtnasc') }}" placeholder="Digite a Data de Nascimento">
        </div>

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="telefone">Telefone:</label>
            <input type="number" name="telefone" id="telefone"
                class="form-control @error('telefone') is-invalid @enderror" autocomplete="telefone" maxlength="14"
                value="{{ old('telefone') }}" placeholder="Digite o Telefone">
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
                <th>Dt Nasc.</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->data_nascimento->format('d/m/Y') }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>
                        <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-info"><span
                                class="glyphicon glyphicon-pencil"></span></a>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('cliente.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $cliente->id }}">
                            <button type="submit" class="btn btn-danger"><span
                                    class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
