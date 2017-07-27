<?php

namespace Maeli\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Maeli\Parceiro;

class ParceiroNovorequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function all()
    {
        $inputs = parent::all();
        $inputs['cpf'] = Parceiro::unformatCpf($inputs['cpf']);
        $inputs['cnpj'] = Parceiro::unformatCnpj($inputs['cnpj']);
        $this->replace($inputs);
        return parent::all();
    }

    public function rules()
    {
        return [
            'nome' => 'required|between:3,80|regex:/^[\pL\s\-]+$/u',
            'cpf' => 'nullable|cpf|required_without_all:cnpj|unique:parceiros',
            'cnpj' => 'nullable|cnpj|required_without_all:cpf|unique:parceiros',
            'email' => 'required|email',
            'telefone' => 'required|regex:/^\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}$/',
            'telefone2' => 'nullable|regex:/^\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}$/',
            'tipo' => 'required|in:hotel,restaurante,transporte,guia,servico_bordo',
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
            'cpf.cpf' => 'Informe um CPF válido',
            'cpf.required_without_all' => 'Informe um ou os dois destes campos: CPF, CNPJ',
            'cpf.unique' => 'Já existe um parceiro com este CPF',
            'cnpj.cnpj' => 'Informe um CNPJ válido',
            'cnpj.required_without_all' => 'Informe um ou os dois destes campos: CPF, CNPJ',
            'cnpj.unique' => 'Já existe um parceiro com este CNPJ',
            'email.required' => 'Informe um email',
            'email.email' => 'Informe um email válido',
            'telefone.required' => 'Informe um telefone principal',
            'telefone.regex' => 'Informe um telefone principal válido',
            'telefone2.nullable' => 'Informe um telefone secundário válido',
            'telefone2.regex' => 'Informe um telefone secundário válido',
            'tipo.required' => 'Selecione um tipo',
            'tipo.in' => 'Selecione um tipo válido',
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
