<?php

namespace Maeli\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Maeli\Cliente;

class ClienteNovoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function all()
    {
        $inputs = parent::all();
        $inputs['cpf'] = Cliente::unformatCpf($inputs['cpf']);
        $this->replace($inputs);
        return parent::all();
    }

    public function rules()
    {
        return [
            'nome' => 'required|between:3,80|regex:/^[\pL\s\-]+$/u',
            'cpf' => 'required|cpf|unique:clientes',
            'rg' => 'required',
            'dt_nascimento' => 'required|date_format:d/m/Y|before:now',
            'email' => 'required|email',
            'telefone' => 'required|regex:/^\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}$/',
            'telefone2' => 'nullable|regex:/^\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}$/',
            'sexo' => 'required|in:m,f',
            'estado_civil' => 'required|in:solteiro,casado,divorciado,viuvo,separado',
            'cep' => 'required|regex:/^[0-9]{5}-[0-9]{3}$/',
            'cidade' => 'required|between:3,60|regex:/^[\pL\s\-]+$/u',
            'bairro' => 'required|between:3,60|regex:/^[a-zA-Z0-9\s-]+$/',
            'rua' => 'required|between:3,60|regex:/^[a-zA-Z0-9\s-]+$/',
            'numero' => 'required|integer',
            'complemento' => 'nullable|between:3,80|regex:/^[a-zA-Z0-9\s-]+$/'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Informe um nome',
            'nome.between' => 'Informe um nome de 3 a 80 caracteres',
            'nome.regex' => 'Informe um nome válido',
            'cpf.required' => 'Informe um CPF',
            'cpf.cpf' => 'Informe um CPF válido',
            'cpf.unique' => 'Já existe um cliente com este CPF',
            'rg.required' => 'Informe um RG',
            'dt_nascimento.required' => 'Informe uma data de nascimento',
            'dt_nascimento.date_format' => 'Informe uma data de nascimento válida',
            'dt_nascimento.before' => 'Informe uma data de nascimento válida',
            'email.required' => 'Informe um email',
            'email.email' => 'Informe um email válido',
            'telefone.required' => 'Informe um telefone principal',
            'telefone.regex' => 'Informe um telefone principal válido',
            'telefone2.nullable' => 'Informe um telefone secundário válido',
            'telefone2.regex' => 'Informe um telefone secundário válido',
            'sexo.required' => 'Selecione um sexo',
            'sexo.in' => 'Selecione um sexo válido',
            'estado_civil.required' => 'Selecione um estado civil',
            'estado_civil.in' => 'Selecione um estado civil válido',
            'cep.required' => 'Informe um CEP',
            'cidade.between' => 'Informe uma cidade de 3 a 60 caracteres',
            'cep.regex' => 'Informe um CEP válido',
            'cidade.required' => 'Informe uma cidade',
            'cidade.regex' => 'Informe uma cidade válida',
            'bairro.required' => 'Informe um bairro',
            'bairro.between' => 'Informe um bairro de 3 a 60 caracteres',
            'bairro.regex' => 'Informe um bairro válido',
            'rua.required' => 'Informe uma rua',
            'rua.between' => 'Informe uma rua de 3 a 60 caracteres',
            'rua.regex' => 'Informe uma rua válida',
            'numero.required' => 'Informe um número',
            'numero.integer' => 'Informe um número válido',
            'complemento.nullable' => 'Informe um complemento válido',
            'complemento.between' => 'Informe um complemento de 3 a 80 caracteres',
            'complemento.regex' => 'Informe um complemento válido',
        ];
    }
}
