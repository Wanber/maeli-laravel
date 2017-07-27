<?php

namespace Maeli;

use Illuminate\Database\Eloquent\Model;

class Consorcio extends Model
{
    public function cliente() {
        return $this->belongsTo('Maeli\Cliente');
    }

    public function pagamentos() {
        return $this->hasMany('Maeli\Pagamento');
    }
}
