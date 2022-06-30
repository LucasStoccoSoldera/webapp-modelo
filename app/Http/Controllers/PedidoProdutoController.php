<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoProdutoRequest;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoProdutoController extends Controller
{
    public function create(PedidoProdutoRequest $pedidoProdutoRequest)
    {
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->id_pedido = $pedidoProdutoRequest->pedido;

        $produtos = PedidoProduto::where('id_pedido', '=', $pedidoProdutoRequest->pedido)->get();
        if ($produtos->contains('id_produto', $pedidoProdutoRequest->produto)) {
            return redirect()->back()->withInput()->withErrors('Produto ' . $pedidoProdutoRequest->produto . ' já cadastrado para o pedido ' . $pedidoProdutoRequest->pedido . '!');
        }

        $pedidoProduto->id_produto = $pedidoProdutoRequest->produto;
        $pedidoProduto->qtde = $pedidoProdutoRequest->qtde;
        $pedidoProduto->save();

        if ($pedidoProduto) {
            return redirect()->route('pedido')->with('mensagem', 'Cadastro realizado com sucesso!');
        }
        return redirect()->back()->withInput()->withErrors('Não foi possível cadastrar. Tente novamente!');
    }

    public function edit($pedido, $produto)
    {

        $pedidoProduto = DB::table('pedido_produto')->join('produto', 'pedido_produto.id_produto', '=', 'produto.id')
            ->select('pedido_produto.id_pedido', 'pedido_produto.id_produto', 'pedido_produto.qtde', 'produto.nome')
            ->where('id_pedido', '=', $pedido)->where('id_produto', '=', $produto)->get();

        return view('editPedidoProduto', ['pedidoProduto' => $pedidoProduto]);
    }

    public function update(PedidoProdutoRequest $pedidoProdutoRequest)
    {

        $update = DB::update(
            'update pedido_produto set qtde = ? where id_pedido = ? and id_produto = ?',
            [$pedidoProdutoRequest->qtde, $pedidoProdutoRequest->pedido, $pedidoProdutoRequest->produto]
        );

        if ($update) {
            return redirect()->route('pedido')->with('mensagem', 'Cadastro atualizado com sucesso!');
        }

        return redirect()->back()->withInput()->withErrors('Não foi possível atualizar. Tente novamente!');
    }

    public function delete(Request $request)
    {

        $delete = DB::delete('delete from pedido_produto where id_pedido = ? and id_produto = ?', [$request->pedido, $request->produto]);

        if ($delete) {
            $msgExcluir = "Produto $request->produto excluído com sucesso do pedido $request->pedido!";
            return redirect()->route('pedido')->with('mensagem', $msgExcluir);
        }
        return redirect()->back()->withInput()->withErrors('Não foi possível excluir. Tente novamente!');
    }
}
