<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'nome' => ['required'],
            'dtnasc' => ['required', 'date', 'before:now'],
            'telefone' => ['required', 'digits_between:11,12'],
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome obrigatório.',
            'dtnasc.required' => 'Data de nascimento obrigatória.',
            'dtnasc.date' => 'Data de nascimento precisa ser uma data.',
            'dtnasc.before' => 'Data de nascimento não pode ser no futuro.',
            'telefone.required' => 'Telefone obrigatório.',
            'telefone.digits_between' => 'Telefone inválido.',
        ];
    }
}
