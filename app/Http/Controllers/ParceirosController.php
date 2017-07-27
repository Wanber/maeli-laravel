<?php

namespace Maeli\Http\Controllers;

use Illuminate\Database\QueryException;
use Maeli\Http\Requests\ParceiroAtualizarRequest;
use Maeli\Http\Requests\ParceiroNovorequest;
use Maeli\Parceiro;
use Mockery\Exception;

class ParceirosController extends Controller
{
    private $parceiro;

    public function __construct(Parceiro $parceiro)
    {
        $this->parceiro = $parceiro;
    }

    public function listar()
    {
        $parceiros = $this->parceiro->all();

        return view('parceiros.listar', ['parceiros' => $parceiros]);
    }

    public function novo()
    {
        return view('parceiros.novo');
    }

    public function novo_salvar(ParceiroNovorequest $parceiroNovorequest)
    {
        try {
            $parceiro = new Parceiro();
            $parceiro->nome = $parceiroNovorequest->get('nome');
            $parceiro->setCpf($parceiroNovorequest->get('cpf'));
            $parceiro->setCnpj($parceiroNovorequest->get('cnpj'));
            $parceiro->tipo = $parceiroNovorequest->get('tipo');
            $parceiro->email = $parceiroNovorequest->get('email');
            $parceiro->settelefone($parceiroNovorequest->get('telefone'));
            $parceiro->settelefone2($parceiroNovorequest->get('telefone2'));
            $parceiro->setCep($parceiroNovorequest->get('cep'));
            $parceiro->cidade = $parceiroNovorequest->get('cidade');
            $parceiro->bairro = $parceiroNovorequest->get('bairro');
            $parceiro->rua = $parceiroNovorequest->get('rua');
            $parceiro->numero = $parceiroNovorequest->get('numero');
            $parceiro->complemento = $parceiroNovorequest->get('complemento', '');

            $parceiro->save();

            return redirect()->route('parceiros.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Parceiro criado com sucesso'
                        ],
                    ]
                ]);

        } catch (Exception $exception) {
            return redirect()->route('parceiros.novo')
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
        $parceiro = $this->parceiro->find($id);

        if (!$parceiro)
            return redirect()->route('parceiros.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Não foi possível eitar: parceiro não encontrado'
                        ],
                    ]
                ]);

        return view('parceiros.editar', ['parceiro' => $parceiro]);
    }

    public function atualizar(ParceiroAtualizarRequest $parceiroAtualizarRequest)
    {
        $parceiro = $this->parceiro->find($parceiroAtualizarRequest->get('id'));

        if (!$parceiro)
            return redirect()->route('parceiros.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Não foi possível eitar: parceiro não encontrado'
                        ],
                    ]
                ]);

        try {
            $parceiro->nome = $parceiroAtualizarRequest->get('nome');
            $parceiro->setCpf($parceiroAtualizarRequest->get('cpf'));
            $parceiro->setCnpj($parceiroAtualizarRequest->get('cnpj'));
            $parceiro->email = $parceiroAtualizarRequest->get('email');
            $parceiro->tipo = $parceiroAtualizarRequest->get('tipo');
            $parceiro->setTelefone($parceiroAtualizarRequest->get('telefone'));
            $parceiro->setTelefone2($parceiroAtualizarRequest->get('telefone2'));
            $parceiro->setCep($parceiroAtualizarRequest->get('cep'));
            $parceiro->cidade = $parceiroAtualizarRequest->get('cidade');
            $parceiro->bairro = $parceiroAtualizarRequest->get('bairro');
            $parceiro->rua = $parceiroAtualizarRequest->get('rua');
            $parceiro->numero = $parceiroAtualizarRequest->get('numero');
            $parceiro->complemento = $parceiroAtualizarRequest->get('complemento', '');

            $parceiro->save();

            return redirect()->route('parceiros.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Parceiro alterado com sucesso'
                        ],
                    ]
                ]);

        } catch (Exception $exception) {
            return redirect()->route('parceiros.novo')
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
        $parceiro = $this->parceiro->find($id);

        if (!$parceiro)
            return redirect()->route('parceiros.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Não foi possível excluir: parceiro não encontrado'
                        ],
                    ]
                ]);

        try {

            $parceiro->delete();

            return redirect()->route('parceiros.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Parceiro excluído com sucesso.'
                        ],
                    ]
                ]);

        } catch (Exception $exception) {


            return redirect()->route('parceiros.listar')
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
