<?php

namespace Maeli\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracoesController extends Controller
{
    public function index() {
        return view('configuracoes.index');
    }
}
