<?php

namespace Maeli;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [

    ];

    public function vendas()
    {
        return $this->belongsToMany('Maeli\Venda', 'passageiros');
    }

    public function consorcios()
    {
        return $this->hasMany('Maeli\Consorcio');
    }

    public function telefones()
    {
        return $this->hasMany('Maeli\Telefone');
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

    public static function formatCep($cep)
    {
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 7);
    }

    public static function unformatCep($cep)
    {
        return str_replace('-', '', $cep);
    }

    public static function formatDt_nascimento($dt_nascimento, $formato)
    {
        return date($formato, strtotime($dt_nascimento));
    }

    public function idade()
    {
        return floor((time() - strtotime($this->dt_nascimento)) / 60 / 60 / 24 / 365) . ' anos';
    }

    public function sexo()
    {
        return $this->sexo == 'm' ? 'Masculino' : 'Feminino';
    }

    public function estado_civil()
    {
        $letra = $this->sexo == 'm' ? 'o' : 'a';

        switch ($this->estado_civil) {
            case 'solteiro':
                return 'Solteir' . $letra;
            case 'casado':
                return 'Casad' . $letra;
            case 'divorciado':
                return 'Divorciad' . $letra;
            case 'viuvo':
                return 'Viúv' . $letra;
            case 'separado':
                return 'Separad' . $letra;
        }
    }

    public function setCpf($cpf)
    {
        $this->cpf = self::unformatCpf($cpf);
    }

    public function cpf()
    {
        return self::formatCpf($this->cpf);
    }

    public function setCep($cep)
    {
        $this->cep = self::unformatCep($cep);
    }

    public function cep()
    {
        return self::formatCep($this->cep);
    }

    public function setDt_nascimento($dt_nascimento)
    {
        $this->dt_nascimento = self::formatDt_nascimento($dt_nascimento, "Y-m-d H:i:s");
    }

    public function dt_nascimento($formato)
    {
        return self::formatDt_nascimento($this->dt_nascimento, $formato);
    }
}
