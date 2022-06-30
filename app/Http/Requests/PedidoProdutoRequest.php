<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'pedido' => ['required'],
            'produto' => ['required'],
            'qtde' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'pedido.required' => 'Pedido obrigatório.',
            'produto.required' => 'Produto obrigatório.',
            'qtde.required' => 'Quantidade obrigatória.',
        ];
    }
}
