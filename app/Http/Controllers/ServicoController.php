<?php

namespace Maeli\Http\Controllers;

use Maeli\Http\Requests\ServicoAtualizaRequest;
use Maeli\Http\Requests\ServicoNovoRequest;
use Maeli\Servico;

class ServicoController extends Controller
{
    private $servico;

    public function __construct(Servico $servico)
    {
        $this->servico = $servico;
    }

    public function listar()
    {
        $servicos = $this->servico->all();

        return view('servicos.listar', ['servicos' => $servicos]);
    }

    public function novo()
    {
        return view('servicos.novo');
    }

    public function novo_salvar(ServicoNovoRequest $servicoNovoRequest)
    {
        try {
            $servico = new Servico();
            $servico->nome = $servicoNovoRequest->get('nome');
            $servico->descricao = $servicoNovoRequest->get('descricao');
            $servico->setCusto($servicoNovoRequest->get('custo'));

            $servico->save();

            return redirect()->route('servicos.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Serviço criado com sucesso'
                        ],
                    ]
                ]);

        } catch (Exception $exception) {
            return redirect()->route('servicos.novo')
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
        $servico = $this->servico->find($id);

        if (!$servico)
            return redirect()->route('servicos.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Não foi possível editar: serviço não encontrado'
                        ],
                    ]
                ]);

        return view('servicos.editar', ['servico' => $servico]);
    }

    public function atualizar(ServicoAtualizaRequest $servicoAtualizaRequest)
    {
        $servico = $this->servico->find($servicoAtualizaRequest->get('id'));

        if (!$servico)
            return redirect()->route('servicos.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Não foi possível editar: serviço não encontrado'
                        ],
                    ]
                ]);

        try {
            $servico->nome = $servicoAtualizaRequest->get('nome');
            $servico->setCusto($servicoAtualizaRequest->get('custo'));
            $servico->descricao = $servicoAtualizaRequest->get('descricao');

            $servico->save();

            return redirect()->route('servicos.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Serviço alterado com sucesso'
                        ],
                    ]
                ]);

        } catch (Exception $exception) {
            return redirect()->route('servicos.editar', ['id' => $servicoAtualizaRequest->get('id')])
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

    public function excluir($id)
    {
        $servico = $this->servico->find($id);

        if (!$servico)
            return redirect()->route('servicos.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Não foi possível excluir: serviço não encontrado'
                        ],
                    ]
                ]);

        try {

            $servico->delete();

            return redirect()->route('servicos.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Serviço excluído com sucesso.'
                        ],
                    ]
                ]);

        } catch (Exception $exception) {

            return redirect()->route('servicos.listar')
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
