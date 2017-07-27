<?php

namespace Maeli;


use Illuminate\Database\Eloquent\Model;

class MercadoPagoTransacao extends Model
{
    public $id;
    public $status;
    public $valor;
    public $valor_moeda;
    public $data;
    public $cliente_email;

    function __construct($transacao)
    {
        $this->id = $transacao['id'];
        $this->status = $transacao['status'];
        $this->valor = number_format($transacao['transaction_amount'], 2);
        $this->valor_moeda = $transacao['currency_id'];
        $this->data = $transacao['date_created'];
        $this->cliente_email = $transacao['payer']['email'];
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 'pending':
                return 'Pendente';
            case 'approved':
                return 'Aprovado';
            case 'in_process':
                return 'Em análise';
            case 'rejected':
                return 'Recusado';
            case 'cancelled':
                return 'Cancelado';
            case 'refunded':
                return 'Reembolsado';
            case 'in_mediation':
                return 'Em mediação';
            case 'charged_back':
                return 'Charge back';
        }
    }

    public function getStatusCorolido() {
        switch ($this->status) {
            case 'pending':
                return '<span class="text-warning">Pendente</span>';
            case 'approved':
                return '<span class="text-success">Aprovado</span>';
            case 'in_process':
                return '<span class="text-info">Em análise</span>';
            case 'rejected':
                return '<span class="text-danger">Recusado</span>';
            case 'cancelled':
                return '<span class="text-danger">Cancelado</span>';
            case 'refunded':
                return '<span class="text-danger">Reembolsado</span>';
            case 'in_mediation':
                return '<span class="text-warning">Em mediação</span>';
            case 'charged_back':
                return '<span class="text-danger">Charge back</span>';
        }
    }

    public function getData($formato) {
        return date($formato, strtotime($this->data));
    }
}
