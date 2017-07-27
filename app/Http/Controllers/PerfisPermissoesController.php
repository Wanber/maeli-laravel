<?php

namespace Maeli\Http\Controllers;

use Illuminate\Http\Request;
use Maeli\Permission;
use Maeli\Role;

class PerfisPermissoesController extends Controller
{
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function listar()
    {
        $perfis = $this->role->all();
        $permissoes = $this->permission->all();
        return view('perfis_permissoes.listar', ['perfis' => $perfis, 'permissoes' => $permissoes]);
    }

    public function novo()
    {
        $perfis = $this->role->whereNotIn('name', ['dev', 'admin'])->get();
        $permissoes = $this->permission->whereNotIn('name', ['mod-dev'])->get();

        return view('perfis_permissoes.novo', ['perfis' => $perfis, 'permissoes' => $permissoes]);
    }

    public function novo_salvar(Request $request)
    {
        return $request->all();
    }

    public function editar($id)
    {
    }

    public function atualizar()
    {
    }

    public function excluir($id)
    {
    }
}
