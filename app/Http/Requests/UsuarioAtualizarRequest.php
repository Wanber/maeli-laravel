<?php

namespace Maeli\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Maeli\User;

class UsuarioAtualizarRequest extends FormRequest
{
    private $modo_edicao;

    public function authorize()
    {
        $usuario = User::find($this->id);

        if (!$usuario)
            return false;

        $perfil = $usuario->roles->get(0);

        if (Auth::user()->id != $this->id) {
            if ($perfil->name == 'dev')
                return false;
            else {
                $this->modo_edicao = 'passivo';
                return true;
            }
        } else {
            $this->modo_edicao = 'ativo';
            return true;
        }
    }

    public function rules()
    {
        return $this->modo_edicao == 'ativo' ?
            [
                'id' => 'required|integer',
                'nome' => 'required|between:3,80|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email',
                'senha' => 'nullable|min:6',
                'senha2' => $this->senha == '' ? 'nullable' : 'required' . '|same:senha',
                'foto' => 'nullable|image',
                'perfil' => 'required|integer'
            ]
            :
            [
                'id' => 'required|integer',
                'perfil' => 'required|integer'
            ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Usuário inválido',
            'id.integer' => 'Usuário inválido',
            'nome.required' => 'Informe um nome',
            'nome.between' => 'Informe um nome de 3 a 80 caracteres',
            'nome.regex' => 'Informe um nome válido',
            'email.required' => 'Informe um email',
            'email.email' => 'Informe um email válido',
            'senha.min' => 'A senha deve ter no mínimo 6 caracteres',
            'senha2.required' => 'Confirme sua senha',
            'senha2.same' => 'As senhas não conferem',
            'foto.image' => 'A foto deve ser um arquivo de imagem',
            'perfil.required' => 'Selecione um perfil',
            'perfil.number' => 'Selecione um perfil válido'
        ];
    }
}
