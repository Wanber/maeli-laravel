<?php

namespace Maeli\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmitirPagamentoRequest extends FormRequest
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
            'mp_pg_titulo' => 'required',
            'mp_pg_desc' => 'required',
            'mp_pg_valor' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'mp_pg_nome' => 'required',
            'mp_pg_sobrenome' => 'required',
            'mp_pg_cpf' => 'required|cpf',
            'mp_pg_email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'mp_pg_titulo.required' => 'Informe um título',
            'mp_pg_desc.required' => 'Informe uma descrição',
            'mp_pg_valor.required' => 'Informe um valor',
            'mp_pg_valor.regex' => 'Informe um valor válido',
            'mp_pg_nome.required' => 'Informe um nome',
            'mp_pg_sobrenome.required' => 'Informe um sobrenome',
            'mp_pg_cpf.required' => 'Informe um CPF',
            'mp_pg_cpf.cpf' => 'Informe um CPF válido',
            'mp_pg_email.required' => 'Informe um email',
            'mp_pg_email.email' => 'Informe um email válido'
        ];
    }
}
