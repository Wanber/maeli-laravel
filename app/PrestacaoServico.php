<?php

namespace Maeli;

use Illuminate\Database\Eloquent\Model;

class PrestacaoServico extends Model
{
    public $timestamps = false;

    public function parceiro()
    {
        return $this->belongsTo('Maeli\Parceiro');
    }

    public function servico()
    {
        return $this->belongsTo('Maeli\Servico');
    }

    public function pacotes()
    {
        return $this->belongsToMany('Maeli\Pacote', 'servicos_inclusos')
            ->withPivot('preco', 'descricao');
    }
}
