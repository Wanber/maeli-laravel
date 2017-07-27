<?php

namespace Maeli;

use Illuminate\Database\Eloquent\Model;

class MercadoPagoConfig extends Model
{
    protected $table = 'mercadopago_config';
    protected $primaryKey = 'config';
    public $timestamps = false;
}
