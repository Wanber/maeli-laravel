<?php

namespace Maeli;

use Illuminate\Database\Eloquent\Model;

class Pacote extends Model
{
    public function prestacao_servicos()
    {
        return $this->belongsToMany('Maeli\PrestacaoServico', 'servicos_inclusos')
            ->withPivot('preco', 'descricao');
    }

    public function vendas() {
        $this->hasMany('Maeli\Venda');
    }

    public static function format_valor($valor)
    {
        $valor_len = strlen($valor);
        return substr($valor, 0, ($valor_len - 2)) . '.' . substr($valor, ($valor_len - 2), 2);
    }

    public static function unformat_valor($valor)
    {
        return str_replace(['.', ','], '', $valor);
    }

    public static function format_data($dt, $formato)
    {
        return date($formato, strtotime($dt));
    }


    public function dt_partida($formato)
    {
        return self::format_data($this->dt_partida, $formato);
    }

    public function dt_chegada($formato)
    {
        return self::format_data($this->dt_chegada, $formato);
    }

    public function setDt_partida($dt_partida)
    {
        $this->dt_partida = self::format_data($dt_partida, "Y-m-d H:i:s");
    }

    public function setDt_chegada($dt_chegada)
    {
        $this->dt_chegada = self::format_data($dt_chegada, "Y-m-d H:i:s");
    }

    public function valor()
    {
        return self::format_valor($this->valor);
    }

    public function setValor($valor)
    {
        $this->valor = self::unformat_valor($valor);
    }
}
