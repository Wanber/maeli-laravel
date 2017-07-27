<?php

namespace Maeli\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Informe um email',
            'email.email' => 'Informe um email válido',
            'password.required' => 'Informe a senha',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres',
        ];
    }
}
