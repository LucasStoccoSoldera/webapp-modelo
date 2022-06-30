<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function show()
    {
        $clientes = Cliente::all();
        return view('cliente', [
            'clientes' => $clientes
        ]);
    }

    public function create(ClienteRequest $clienteRequest)
    {
        $cliente = new Cliente();
        $cliente->nome = $clienteRequest->nome;
        $cliente->data_nascimento = $clienteRequest->dtnasc;
        $cliente->telefone = $clienteRequest->telefone;
        $cliente->save();

        if ($cliente) {
            return redirect()->route('cliente')->with('mensagem', 'Cadastro realizado com sucesso!');
        }
        return redirect()->back()->withInput()->withErrors('Não foi possível cadastrar. Tente novamente!');
    }

    public function edit($id)
    {
        $cliente = Cliente::findorfail($id);
        return view('editCliente', ['cliente' => $cliente]);
    }

    public function update(ClienteRequest $clienteRequest)
    {
        $cliente =  Cliente::find($clienteRequest->id);
        $cliente->nome = $clienteRequest->nome;
        $cliente->data_nascimento = $clienteRequest->dtnasc;
        $cliente->telefone = $clienteRequest->telefone;
        $cliente->save();

        $pedido = Pedido::where('id_cliente', '=', $cliente->id)->first();
        $pedido->id_cliente = $cliente->id;
        $pedido->save();

        if ($cliente) {
            return redirect()->route('cliente')->with('mensagem', 'Cadastro atualizado com sucesso!');
        }

        return redirect()->back()->withInput()->withErrors('Não foi possível atualizar. Tente novamente!');
    }

    public function delete(Request $request)
    {

        $pedido = Pedido::where('id_cliente', $request->id)->get();

        if ($pedido) {
            return redirect()->back()->withInput()->withErrors('Existem pedidos para esse cliente!');
        }
        $cliente = Cliente::find($request->id);
        $descricao = $cliente->nome;
        $cliente->delete();

        if ($cliente) {
            $msgExcluir = "Cliente $descricao excluído com sucesso!";
            return redirect()->route('cliente')->with('mensagem', $msgExcluir);
        }
        return redirect()->back()->withInput()->withErrors('Não foi possível excluir. Tente novamente!');
    }
}
