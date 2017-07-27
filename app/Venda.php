<?php

namespace Maeli;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    public function pacote()
    {
        return $this->belongsTo('Maeli\Pacote');
    }

    public function pagamentos()
    {
        return $this->hasMany('Maeli\Pagamento');
    }

    public function passageiros() {
        return $this->belongsToMany('Maeli\Cliente', 'passageiros');
    }
}
