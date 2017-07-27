<?php

namespace Maeli;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo('Maeli\Cliente');
    }

    public static function formatNumero($numero)
    {
        return strlen($numero) > 10 ? '(' .
            substr($numero, 0, 2) . ')' .
            substr($numero, 2, 5) . '-' .
            substr($numero, 7, 4)
            : '(' .
            substr($numero, 0, 2) . ')' .
            substr($numero, 2, 4) . '-' .
            substr($numero, 6, 4);
    }

    public static function unformatNumero($numero) {
        return str_replace(['(', ')', '-'], '', $numero);
    }

    public function numero()
    {
        return self::formatNumero($this->numero);
    }

    public function setNumero($numero)
    {
        $this->numero = self::unformatNumero($numero);
    }
}
