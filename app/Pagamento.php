<?php

namespace Maeli;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    public function venda()
    {
        return $this->belongsTo('Maeli\Venda');
    }

    public function consorcio()
    {
        return $this->belongsTo('Maeli\Consorcio');
    }

    //aqui é um ou outro, ver se assim da pau
}