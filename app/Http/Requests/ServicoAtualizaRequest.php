<?php

namespace Maeli\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicoAtualizaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer',
            'nome' => 'required|between:3,80|regex:/^[\pL\s\-]+$/u',
            'descricao' => 'required',
            'custo' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Cliente não encontrado',
            'id.integer' => 'Cliente inválido',
            'nome.required' => 'Informe um nome',
            'nome.between' => 'Informe um nome de 3 a 80 caracteres',
            'nome.regex' => 'Informe um nome válido',
            'descricao.required' => 'Informe uma descrição',
            'custo.required' => 'Informe um valor',
            'custo.regex' => 'Informe um valor válido',
        ];
    }
}
