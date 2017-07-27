<?php

namespace Maeli;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /*
    public $name = 'admin';
    public $display_name = 'Administrador';
    public $description = 'Administrador do sistema';
    */

    public function permissions() {
        return $this->belongsToMany('Maeli\Permission');
    }
}