<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function show()
    {
        $usuarios = Usuario::all();
        return view('usuario', [
            'usuarios' => $usuarios
        ]);
    }


    public function create(usuarioRequest $usuarioRequest)
    {
        $usuario = new Usuario();
        $usuario->nome = $usuarioRequest->nome;
        $usuario->login = $usuarioRequest->login;
        $usuario->senha = Hash::make($usuarioRequest->senha);
        $usuario->save();

        if ($usuario) {
            return redirect()->route('usuario')->with('mensagem', 'Cadastro realizado com sucesso!');
        }
        return redirect()->back()->withInput()->withErrors('Não foi possível cadastrar. Tente novamente!');
    }

    public function edit($id)
    {
        $usuario = Usuario::findorfail($id);
        return view('editUsuario', ['usuario' => $usuario]);
    }

    public function update(UsuarioUpdateRequest $usuarioUpdateRequest)
    {
        $usuario =  Usuario::find($usuarioUpdateRequest->id);
        $duplo = Usuario::where('login', $usuarioUpdateRequest->login)->first();

        if ($duplo && $duplo->id != $usuarioUpdateRequest->id) {
            return redirect()->back()->withInput()->withErrors('Usuário já existe!');
        }
        $usuario->nome = $usuarioUpdateRequest->nome;
        $usuario->login = $usuarioUpdateRequest->login;
        $usuario->senha = Hash::make($usuarioUpdateRequest->senha);
        $usuario->save();

        if ($usuario) {
            return redirect()->route('usuario')->with('mensagem', 'Cadastro atualizado com sucesso!');
        }

        return redirect()->back()->withInput()->withErrors('Não foi possível atualizar. Tente novamente!');
    }

    public function delete(Request $request)
    {

        $usuario = Usuario::find($request->id);

        if (Auth::user() == $usuario) {
            return redirect()->back()->withInput()->withErrors('Usuário em uso no momento!');
        }
        $usuario = Usuario::find($request->id);
        $descricao = $usuario->nome;
        $usuario->delete();

        if ($usuario) {
            $msgExcluir = "Usuario $descricao excluído com sucesso!";
            return redirect()->route('usuario')->with('mensagem', $msgExcluir);
        }
        return redirect()->back()->withInput()->withErrors('Não foi possível excluir. Tente novamente!');
    }
}
