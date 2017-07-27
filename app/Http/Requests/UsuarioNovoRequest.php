<?php

namespace Maeli\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioNovoRequest extends FormRequest
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
            'nome' => 'required|between:3,80|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:users',
            'senha' => 'required|min:6',
            'senha2' => 'required|same:senha',
            'foto' => 'required|image',
            'perfil' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Informe um nome',
            'nome.between' => 'Informe um nome de 3 a 80 caracteres',
            'nome.regex' => 'Informe um nome válido',
            'email.required' => 'Informe um email',
            'email.email' => 'Informe um email válido',
            'email.unique' => 'Já existe um usuário com este email',
            'senha.required' => 'Informe uma senha',
            'senha.min' => 'A senha deve ter no mínimo 6 caracteres',
            'senha2.required' => 'Informe a confirmação da senha',
            'senha2.same' => 'As senhas não conferem',
            'foto.required' => 'Selecione uma foto',
            'foto.image' => 'A foto deve ser um arquivo de imagem',
            'perfil.required' => 'Selecione um perfil',
            'perfil.number' => 'Selecione um perfil válido'
        ];
    }
}
