<?php

namespace Maeli\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;
use Maeli\Cliente;
use Maeli\Http\Requests\ClienteAtualizarRequest;
use Maeli\Http\Requests\ClienteNovoRequest;
use Maeli\Telefone;

class ClienteController extends Controller
{
    /**
     * @var Cliente
     */
    private $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function listar()
    {
        $clientes = $this->cliente->all();

        return view('clientes.listar', ['clientes' => $clientes]);
    }

    public function novo()
    {
        return view('clientes.novo');
    }

    public function novo_salvar(ClienteNovoRequest $clienteNovoRequest)
    {
        try {
            $cliente = new Cliente();
            $cliente->nome = $clienteNovoRequest->get('nome');
            $cliente->setCpf($clienteNovoRequest->get('cpf'));
            $cliente->rg = $clienteNovoRequest->get('rg');
            $cliente->setDt_nascimento($clienteNovoRequest->get('dt_nascimento'));
            $cliente->email = $clienteNovoRequest->get('email');
            $cliente->sexo = $clienteNovoRequest->get('sexo');
            $cliente->estado_civil = $clienteNovoRequest->get('estado_civil');
            $cliente->setCep($clienteNovoRequest->get('cep'));
            $cliente->cidade = $clienteNovoRequest->get('cidade');
            $cliente->bairro = $clienteNovoRequest->get('bairro');
            $cliente->rua = $clienteNovoRequest->get('rua');
            $cliente->numero = $clienteNovoRequest->get('numero');
            $cliente->complemento = $clienteNovoRequest->get('complemento', '');

            $cliente->save();

            $telefone = new Telefone();
            $telefone->setNumero($clienteNovoRequest->get('telefone'));
            $cliente->telefones()->save($telefone);

            if ($clienteNovoRequest->get('telefone2', '') != '') {
                $telefone2 = new Telefone();
                $telefone2->setNumero($clienteNovoRequest->get('telefone2'));
                $cliente->telefones()->save($telefone2);
            }

            return redirect()->route('clientes.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Cliente criado com sucesso'
                        ],
                    ]
                ]);

        } catch (Exception $exception) {
            return redirect()->route('clientes.novo')
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
        $cliente = $this->cliente->find($id);

        if (!$cliente)
            return redirect()->route('clientes.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Não foi possível eitar: cliente não encontrado'
                        ],
                    ]
                ]);

        return view('clientes.editar', ['cliente' => $cliente]);
    }

    public function atualizar(ClienteAtualizarRequest $clienteAtualizarRequest)
    {
        $cliente = $this->cliente->find($clienteAtualizarRequest->get('id'));

        if (!$cliente)
            return redirect()->route('clientes.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Não foi possível editar: cliente não encontrado'
                        ],
                    ]
                ]);


        try {
            $cliente->nome = $clienteAtualizarRequest->get('nome');
            $cliente->setCpf($clienteAtualizarRequest->get('cpf'));
            $cliente->rg = $clienteAtualizarRequest->get('rg');
            $cliente->setDt_nascimento($clienteAtualizarRequest->get('dt_nascimento'));
            $cliente->email = $clienteAtualizarRequest->get('email');
            $cliente->sexo = $clienteAtualizarRequest->get('sexo');
            $cliente->estado_civil = $clienteAtualizarRequest->get('estado_civil');
            $cliente->setCep($clienteAtualizarRequest->get('cep'));
            $cliente->cidade = $clienteAtualizarRequest->get('cidade');
            $cliente->bairro = $clienteAtualizarRequest->get('bairro');
            $cliente->rua = $clienteAtualizarRequest->get('rua');
            $cliente->numero = $clienteAtualizarRequest->get('numero');
            $cliente->complemento = $clienteAtualizarRequest->get('complemento', '');

            $cliente->save();
            $cliente->telefones()->delete();

            $telefone = new Telefone();
            $telefone->setNumero($clienteAtualizarRequest->get('telefone'));
            $cliente->telefones()->save($telefone);

            if ($clienteAtualizarRequest->get('telefone2', '') != '') {
                $telefone2 = new Telefone();
                $telefone2->setNumero($clienteAtualizarRequest->get('telefone2'));
                $cliente->telefones()->save($telefone2);
            }

            return redirect()->route('clientes.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Cliente alterado com sucesso'
                        ],
                    ]
                ]);

        } catch (Exception $exception) {
            return redirect()->route('clientes.editar', ['id' => $clienteAtualizarRequest->get('id')])
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
        $cliente = $this->cliente->find($id);

        if (!$cliente)
            return redirect()->route('clientes.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'warning',
                            'text' => 'Não foi possível excluir: cliente não encontrado'
                        ],
                    ]
                ]);

        try {

            $cliente->telefones()->delete();
            $cliente->delete();

            return redirect()->route('clientes.listar')
                ->with(['msgs' =>
                    [
                        [
                            'tipo' => 'success',
                            'text' => 'Cliente excluído com sucesso.'
                        ],
                    ]
                ]);

        } catch (Exception $exception) {

            return redirect()->route('clientes.listar')
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
