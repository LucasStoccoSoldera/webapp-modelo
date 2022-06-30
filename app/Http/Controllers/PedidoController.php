<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoRequest;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function show()
    {
        $clientes = Cliente::all();
        $pedidos = DB::table('pedido')->join('pedido_produto', 'pedido_produto.id_pedido', '=', 'pedido.id')
            ->join('produto', 'pedido_produto.id_produto', '=', 'produto.id')
            ->select('pedido.id', 'pedido.id_cliente', DB::raw('SUM(produto.preco * pedido_produto.qtde) as preco'))
            ->groupBy('pedido.id', 'pedido.id_cliente')
            ->get();
        $produtos = Produto::all();
        $pedidoProdutos = DB::table('pedido_produto')->join('pedido', 'pedido.id', '=', 'pedido_produto.id_pedido')
            ->join('produto', 'produto.id', '=', 'pedido_produto.id_produto')
            ->select('pedido_produto.id_pedido', 'pedido_produto.id_produto', 'pedido_produto.qtde', DB::raw('(produto.preco * pedido_produto.qtde) as preco'))->get();
        return view('pedido', [
            'clientes' => $clientes,
            'pedidos' => $pedidos,
            'produtos' => $produtos,
            'pedidoProdutos' => $pedidoProdutos
        ]);
    }

    public function create(pedidoRequest $pedidoRequest)
    {
        $pedido = new pedido();
        $pedido->id_cliente = $pedidoRequest->cliente;
        $pedido->save();

        if ($pedido) {
            return redirect()->route('pedido')->with('mensagem', 'Cadastro realizado com sucesso!');
        }
        return redirect()->back()->withInput()->withErrors('Não foi possível cadastrar. Tente novamente!');
    }

    public function delete(Request $request)
    {
        $pedido = Pedido::find($request->id);
        $descricao = $pedido->nome;
        $pedido->delete();

        if ($pedido) {
            $msgExcluir = "Pedido $descricao excluído com sucesso!";
            return redirect()->route('pedido')->with('mensagem', $msgExcluir);
        }
        return redirect()->back()->withInput()->withErrors('Não foi possível excluir. Tente novamente!');
    }
}
