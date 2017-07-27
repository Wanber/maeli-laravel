<?php

namespace Maeli\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maeli\Http\Requests\UsuarioAtualizarRequest;
use Maeli\Http\Requests\UsuarioNovoRequest;
use Maeli\Role;
use Maeli\User;

class UsuariosController extends Controller
{
    private $role;
    private $user;

    public function __construct(Role $role, User $user)
    {
        $this->role = $role;
        $this->user = $user;
    }

    public function listar()
    {
        $usuarios = $this->user->all();

        return view('usuarios.listar', ['usuarios' => $usuarios]);
    }

    public function novo()
    {
        $perfis = $this->role->whereNotIn('name', ['dev'])->get();
        return view('usuarios.novo', ['perfis' => $perfis]);
    }

    public function novo_salvar(UsuarioNovoRequest $usuarioNovoRequest)
    {
        $foto = Input::file('foto');
        $nome = $usuarioNovoRequest->get('nome');
        $email = $usuarioNovoRequest->get('email');
        $senha = bcrypt($usuarioNovoRequest->get('senha'));
        $perfil_id = $usuarioNovoRequest->get('perfil');

        if (!$foto->isValid())
            return redirect()->route('usuarios.novo')
                ->withInput()
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'error',
                            'text' => 'Imagem inválida'
                        ],
                    ]
                ]);

        try {
            $destino = 'images/uploads';
            $extensao = $foto->getClientOriginalExtension();
            $nome_arquivo = 'user-' . rand(1000, 9999) . '-' . rand(1000, 9999) . '.' . $extensao;
            $foto_path = str_replace('\\', '/', $foto->move($destino, $nome_arquivo));

            $user = new User();
            $user->name = $nome;
            $user->email = $email;
            $user->password = $senha;
            $user->foto_path = $foto_path;
            $user->remember_token = str_random(10);

            $user->save();
            $user->roles()->attach($perfil_id);

            return redirect()->route('usuarios.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Usuário criado com sucesso'
                        ],
                    ]
                ]);

        } catch (Exception $exception) {

            return redirect()->route('usuarios.novo')
                ->withInput()
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'error',
                            'text' => $exception->getMessage()
                        ],
                    ]
                ]);
        }
    }

    public function editar($id)
    {
        $usuario = $this->user->find($id);
        $perfis = Auth::user()->hasRole('dev') ? $this->role->all() : $this->role->whereNotIn('name', ['dev'])->get();

        if (!$usuario)
            return redirect()->route('usuarios.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Não foi possível eitar: usuário não encontrado'
                        ],
                    ]
                ]);

        return view('usuarios.editar', ['usuario' => $usuario, 'perfis' => $perfis]);
    }

    public function atualizar(UsuarioAtualizarRequest $usuarioAtualizarRequest)
    {
        $usuario = $this->user->find($usuarioAtualizarRequest->get('id'));
        $modo_edicao = '';

        if (!$usuario)
            return redirect()->route('usuarios.listar')->with(['msgs' =>
                [
                    [
                        'tipo' => 'error',
                        'text' => 'Não foi possível eitar: usuário não encontrado'
                    ],
                ]
            ]);

        $perfil = $usuario->roles->get(0);

        if (Auth::user()->id != $usuario->id) {
            if ($perfil->name == 'dev')
                return redirect()->route('usuarios.listar')->with(['msgs' =>
                    [
                        [
                            'tipo' => 'error',
                            'text' => 'Você não pode editar um usuário desenvolvedor'
                        ],
                    ]
                ]);
            else {
                $modo_edicao = 'passivo';
            }
        } else {
            $modo_edicao = 'ativo';
        }

        if ($modo_edicao == 'ativo') {

            try {
                $usuario->name = $usuarioAtualizarRequest->get('nome');
                $usuario->email = $usuarioAtualizarRequest->get('email');

                $senha = $usuarioAtualizarRequest->get('senha');

                if ($senha != '')
                    $usuario->password = bcrypt($senha);

                if ($foto = Input::file('foto')) {
                    $destino = 'images/uploads';
                    $extensao = $foto->getClientOriginalExtension();
                    $nome_arquivo = 'user-' . rand(1000, 9999) . '-' . rand(1000, 9999) . '.' . $extensao;
                    $foto_path = str_replace('\\', '/', $foto->move($destino, $nome_arquivo));
                    $usuario->foto_path = $foto_path;
                }

                $usuario->save();

                $usuario->roles()->sync($usuarioAtualizarRequest->get('perfil'));

                return redirect()->route('usuarios.listar')->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Usuário atualizado com sucesso'
                        ],
                    ]
                ]);

            } catch (Exception $exception) {

                return redirect()->route('usuarios.listar')->with(['msgs' =>
                    [
                        [
                            'tipo' => 'error',
                            'text' => $exception->getMessage()
                        ],
                    ]
                ]);
            }

        } else {

            try {
                $usuario->roles()->sync($usuarioAtualizarRequest->get('perfil'));

                return redirect()->route('usuarios.listar')->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Usuário atualizado com sucesso'
                        ],
                    ]
                ]);

            } catch (Exception $exception) {

                return redirect()->route('usuarios.listar')->with(['msgs' =>
                    [
                        [
                            'tipo' => 'error',
                            'text' => $exception->getMessage()
                        ],
                    ]
                ]);
            }
        }
    }

    public function excluir($id)
    {
        $usuario = $this->user->find($id);
        $perfil = $usuario->roles->get(0);

        if ($perfil->name == 'dev')
            return redirect()->route('usuarios.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Você não pode excluir Desenvolvedores'
                        ],
                    ]
                ]);

        if (Auth::user()->id == $usuario->id)
            return redirect()->route('usuarios.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Você não pode excluir a si mesmo'
                        ],
                    ]
                ]);


        if (!$usuario)
            return redirect()->route('usuarios.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Não foi possível excluir: usuário não encontrado'
                        ],
                    ]
                ]);

        try {

            $usuario->delete();

            return redirect()->route('usuarios.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Usuário excluído com sucesso.'
                        ],
                    ]
                ]);

        } catch (Exception $exception) {


            return redirect()->route('usuarios.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'error',
                            'text' => $exception->getMessage()
                        ],
                    ]
                ]);
        }
    }
}
