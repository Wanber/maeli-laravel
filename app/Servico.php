<?php

namespace Maeli;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    public $timestamps = false;

    public function servicos_prestados()
    {
        return $this->hasMany('Maeli\PrestacaoServico');
    }

    public static function format_custo($custo)
    {
        $custo_len = strlen($custo);
        return substr($custo, 0, ($custo_len - 2)) . '.' . substr($custo, ($custo_len - 2), 2);
    }

    public static function unformat_custo($custo)
    {
        return str_replace(['.', ','], '', $custo);
    }

    public function custo()
    {
        return self::format_custo($this->custo);
    }

    public function setCusto($custo)
    {
        $this->custo = self::unformat_custo($custo);
    }
}
