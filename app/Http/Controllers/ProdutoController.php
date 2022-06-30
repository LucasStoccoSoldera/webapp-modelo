<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Database\Factories\ProdutoFactory;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function show()
    {
        $produtos = Produto::all();
        return view('produto', [
            'produtos' => $produtos
        ]);
    }

    public function create(produtoRequest $produtoRequest)
    {
        $produto = new Produto();
        $produto->nome = $produtoRequest->nome;
        $produto->preco = $produtoRequest->preco;
        $produto->save();

        if ($produto) {
            return redirect()->route('produto')->with('mensagem', 'Cadastro realizado com sucesso!');
        }
        return redirect()->back()->withInput()->withErrors('Não foi possível cadastrar. Tente novamente!');
    }

    public function edit($id)
    {
        $produto = Produto::findorfail($id);
        return view('editProduto', ['produto' => $produto]);
    }

    public function update(produtoRequest $produtoRequest)
    {
        $produto =  Produto::find($produtoRequest->id);
        $produto->nome = $produtoRequest->nome;
        $produto->preco = $produtoRequest->preco;
        $produto->save();

        if ($produto) {
            return redirect()->route('produto')->with('mensagem', 'Cadastro atualizado com sucesso!');
        }

        return redirect()->back()->withInput()->withErrors('Não foi possível atualizar. Tente novamente!');
    }

    public function delete(Request $request)
    {
        $produto = Produto::find($request->id);
        $descricao = $produto->nome;
        $produto->delete();

        if ($produto) {
            $msgExcluir = "Produto $descricao excluído com sucesso!";
            return redirect()->route('produto')->with('mensagem', $msgExcluir);
        }
        return redirect()->back()->withInput()->withErrors('Não foi possível excluir. Tente novamente!');
    }
}
