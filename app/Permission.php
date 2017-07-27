<?php

namespace Maeli;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    /*
    public $name = 'admin';
    public $display_name = 'Administrador';
    public $description = 'Administrador do sistema';
    */

    public function role() {
        return $this->belongsToMany('Maeli\Role');
    }
}
