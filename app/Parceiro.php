<?php

namespace Maeli;

use Illuminate\Database\Eloquent\Model;

class Parceiro extends Model
{
    public function servicos_prestados() {
        return $this->hasMany('Maeli\PrestacaoServico');
    }

    public static function formatCpf($cpf)
    {
        return substr($cpf, 0, 3) . '.' .
            substr($cpf, 3, 3) . '.' .
            substr($cpf, 6, 3) . '-' .
            substr($cpf, 9, 2);
    }

    public static function unformatCpf($cpf)
    {
        return str_replace(['.', '-'], '', $cpf);
    }

    public static function formatCnpj($cnpj)
    {
        return substr($cnpj, 0, 2) . '.' .
        substr($cnpj, 2, 3) . '.' .
        substr($cnpj, 5, 3) . '/' .
        substr($cnpj, 8, 4) . '-' .
        substr($cnpj, 12, 2);
    }

    public static function unformatCnpj($cnpj)
    {
        return str_replace(['.', '-', '/'], '', $cnpj);
    }

    public static function formatCep($cep)
    {
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 7);
    }

    public static function unformatCep($cep)
    {
        return str_replace('-', '', $cep);
    }


    public function tipo()
    {
        switch ($this->tipo) {
            case 'hotel':
                return 'Hotel';
            case 'restaurante':
                return 'Restaurante';
            case 'transporte':
                return 'Transporte';
            case 'guia':
                return 'Guia Turístico';
            case 'servico_bordo':
                return 'Serviço de bordo';
        }
    }

    public function tipoColorido()
    {

        switch ($this->tipo) {
            case 'hotel':
                return '<span class="text-primary">Hotel</span>';
            case 'restaurante':
                return '<span class="text-success">Restaurante</span>';
            case 'transporte':
                return '<span class="text-info">Transporte</span>';
            case 'guia':
                return '<span class="text-warning">Guia Turístico</span>';
            case 'servico_bordo':
                return '<span class="text-danger">Serviço de bordo</span>';
        }
    }

    public function cpf()
    {
        if ($this->cpf == '')
            return '';
        else
            return self::formatCpf($this->cpf);
    }

    public function cnpj()
    {
        if ($this->cnpj == '')
            return '';
        else
            return self::formatCnpj($this->cnpj);
    }

    public function cep()
    {
        return self::formatCep($this->cep);
    }

    public function telefone()
    {
        if ($this->telefone == '')
            return '';
        else
            return Telefone::formatNumero($this->telefone);
    }

    public function setTelefone($numero)
    {
        $this->telefone = Telefone::unformatNumero($numero);
    }

    public function telefone2()
    {
        if ($this->telefone2 == '')
            return '';
        else
            return Telefone::formatNumero($this->telefone2);
    }

    public function setTelefone2($numero)
    {
        $this->telefone2 = Telefone::unformatNumero($numero);
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf == '' ? NULL : self::unformatCpf($cpf);
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj == '' ? NULL : self::unformatCnpj($cnpj);
    }

    public function setCep($cep)
    {
        $this->cep = self::unformatCep($cep);
    }
}
