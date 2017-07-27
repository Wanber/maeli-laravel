<?php

namespace Maeli\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicoNovoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'nome' => 'required|between:3,80|regex:/^[\pL\s\-]+$/u',
            'descricao' => 'required',
            'custo' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Informe um nome',
            'nome.between' => 'Informe um nome de 3 a 80 caracteres',
            'nome.regex' => 'Informe um nome válido',
            'descricao.required' => 'Informe uma descrição',
            'custo.required' => 'Informe um valor',
            'custo.regex' => 'Informe um valor válido',
        ];
    }
}
