<?php

namespace Maeli\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maeli\Http\Requests\LoginRequest;
use Maeli\User;
use Mockery\Exception;

class AuthController extends Controller
{

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login()
    {
        return Auth::check() ?
            redirect()->route('dashboard')
            : view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        return Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ], $request->get('remember', 'nao') == 'sim' ? true : false) ?
            redirect()->intended('/')
            : redirect()->route('login')
                ->withInput()
                ->withErrors(['Usuário ou senha inválidos']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function resetar_senha()
    {
        return view('auth.resetar_senha');
    }

    public function postResetar_senha(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['email' => ['required', 'email']],
            [
                'email.required' => 'Informe um email',
                'email.email' => 'Informe um email válido'
            ]
        );

        if ($validator->fails())
            return redirect()->route('resetar_senha')->withInput()
                ->withErrors([$validator->errors()->get('email')]);

        $email = $request->get('email');
        $user = $this->user->where('email', $email)->first();

        if (!$user)
            return redirect()->route('resetar_senha')
                ->withInput()
                ->withErrors(['Email não encontrado']);


        DB::table('password_resets')->where('email', $email)->delete();

        $token = str_random(64);

        DB::table(config('auth.passwords.users.table'))->insert([
            'email' => $user->email,
            'token' => $token
        ]);

        try {
            $email_content = ['titulo' => 'Olá, ' . $user->name,
                'conteudo' => 'Você requisitou a redefinição de senha da sua conta em ' . config('app.name') . '<br />
                    Para completar a ação clique no link abaixo, se você não requisitou esta ação, desconsidere este email.',
                'acao' => ['nome' => 'Redefinir senha', 'link' => route('tokenResetar_senha', ['token' => $token])]];

            Mail::send('email.basico', $email_content, function ($message) {

                $message->from('naoresponda@maeli.sytes.net', config('app.name'));
                $message->to('wanber@outlook.com')->subject('Redefinição de senha');

            });
        } catch (\Exception $exception) {
            return redirect()->route('resetar_senha')
                ->withInput()
                ->withErrors($exception->getMessage());
        }

        return redirect()->route('resetar_senha')
            ->withInput()
            ->with(
                ['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Um email com o link para redefinição de senha foi enviado para ' . $email
                        ],
                    ]
                ]
            );
    }

    public function tokenResetar_senha($token)
    {
        $reset_request = DB::table('password_resets')->where('token', $token)->first();

        if (!$reset_request)
            return redirect()->route('login')
                ->withErrors(['Link de redefinição de senha inválido.']);

        return view('auth.resetar_senha_nova', ['token' => $token]);
    }

    public function atualizar_senha(Request $request)
    {
        $token = $request->get('token', '');

        $reset_request = DB::table('password_resets')->where('token', $token)->first();

        if (!$reset_request)
            return redirect()->route('login')
                ->withErrors(['Link de redefinição de senha inválido.']);

        $email = $reset_request->email;

        $validator = Validator::make(
            $request->all(),
            [
                'nova_senha' => ['required', 'min:6'],
                'nova_senha2' => ['required', 'same:nova_senha']
            ],
            [
                'nova_senha.required' => 'Informe a nova senha',
                'nova_senha.min' => 'A nova senha deve ter no mínimo 6 caracteres',
                'nova_senha2.required' => 'Informe a confirmação da nova senha',
                'nova_senha2.same' => 'As senhas não são iguais'
            ]
        );

        if ($validator->fails())
            return redirect()->route('tokenResetar_senha', ['token' => $token])
                ->withErrors([$validator->errors()->all()]);

        $nova_senha = bcrypt($request->get('nova_senha'));

        try {
            $user = $this->user->where('email', $email)->first();

            $user->password = $nova_senha;
            $user->save();

            DB::table('password_resets')->where('token', $token)->delete();

        } catch (Exception $exception) {
            return redirect()->route('login')
                ->withErrors([$exception->getMessage()]);
        }

        return redirect()->route('login')
            ->with(
                ['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Sua senha foi alterada com sucesso'
                        ],
                    ]
                ]
            );
    }
}
