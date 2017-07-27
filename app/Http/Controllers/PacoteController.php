<?php

namespace Maeli\Http\Controllers;

use Maeli\Pacote;

class PacoteController extends Controller
{
    private $pacote;

    public function __construct(Pacote $pacote)
    {
        $this->pacote = $pacote;
    }

    public function listar()
    {
        $pacotes = $this->pacote->all();

        return view('pacotes.listar', ['pacotes' => $pacotes]);
    }

    public function novo()
    {
        return view('pacotes.novo');
    }

    public function novo_salvar(ParceiroNovorequest $parceiroNovorequest)
    {

    }

    public function editar($id)
    {

    }

    public function atualizar(ParceiroAtualizarRequest $parceiroAtualizarRequest)
    {

    }

    public function excluir($id)
    {

    }
}
