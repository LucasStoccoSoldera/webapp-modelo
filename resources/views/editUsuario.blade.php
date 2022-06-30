@extends('template.layout')

@section('title', 'Atualizar Usuário')

@section('form-tittle', 'Atualizar Usuário')
@section('form')
    <form id="usuarioForm" name="usuarioForm" class="form-horizontal" role="form" method="POST"
        action="{{ route('usuario.update') }}">
        @csrf
        @method('PUT')

        <input type="text" name="id" value="{{ $usuario->id }}" hidden>
        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="nome">Nome Completo:</label>
            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                maxlength="80" value="{{ $usuario->nome }}" autocomplete="nome" placeholder="Digite o nome completo">
        </div>

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="login">Login:</label>
            <input type="text" name="login" id="login" class="form-control @error('login') is-invalid @enderror"
                autocomplete="login" maxlength="80" value="{{ $usuario->login }}" placeholder="Digite o usuário">
        </div>

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control @error('senha') is-invalid @enderror"
                autocomplete="senha" maxlength="100" value="" placeholder="Digite a senha">
        </div>

        <div style="margin-bottom: 25px" class="form-group col-lg-12">
            <label for="senha">Confirmar Senha:</label>
            <input type="password" name="senha_confirmation" id="senha_confirmation"
                class="form-control @error('senha_confirmation') is-invalid @enderror" maxlength="100" value=""
                placeholder="Confirme sua senha">
        </div>

        <div style="margin-top:10px;">
            <a id="btn-danger" href="{{ route('usuario') }}" class="btn btn-danger">Voltar</a>
            <button id="btn-add" type="submit" class="btn btn-success" style="float: right;">Atualizar</button>
        </div>
    </form>
@endsection
