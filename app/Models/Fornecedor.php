<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $fillable = [
        "nm_fornecedor",
        "nr_cpf_cnpj",
        "nr_telefone",
        "nr_rg",
        "dt_cadastro",
        "dt_nascimento",
        'empresa_id',
    ];

  /**
   * @param $value
   *Seta UpperCase no atributo Nome
   */
    public function setNmFornecedorAttribute($value)
    {
      $this->attributes["nm_fornecedor"] = strtoupper($value);
    }

  /**
   * @param $value
   * Remove caracteres especiais
   */
    public function setNrCpfcnpjAttribute($value)
    {
      $this->attributes["nr_cpf_cnpj"] = preg_replace('/[^0-9]/', "", $value);
    }

  /**
   * @param $value
   *  Remove caracteres especiais
   */
    public function setNrTelefoneAttibute($value)
    {
      $this->attributes['nr_telefone'] = preg_replace('/[^0-9]+/g', "", $value);
    }

  /**
   * @return mixed|string|string[]|null
   * Retorna Cpf ou Cnpj formatado
   */
    public function getNrCpfCnpjFormattedAttribute()
    {
      $value = $this->nr_cpf_cnpj;
      if (strlen($value) == 11)
        $value = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value);
      else
        $value = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3.$4-$5', $value);

      return $value;
    }

  /**
   * @param $flFornecedor
   * @return Fornecedor[]|\Illuminate\Database\Eloquent\Collection
   * Retorna todos ou um Fornecedor em especifico
   */
    public function getFornecedor($flFornecedor, $dtCadastro, $strFiltro)
    {
      if ($flFornecedor == null && $dtCadastro == null && $strFiltro == null)
        return $this->all();

        if ($flFornecedor)
          return $this->where('nm_fornecedor', 'LIKE', "%{$flFornecedor}%")
                  ->orWhere('nr_cpf_cnpj','=', $flFornecedor)->get();

        if ($dtCadastro && $strFiltro)
          return $this->where('dt_cadastro', $strFiltro, $dtCadastro)->get();

    }

  /**
   * @param $dtNascimento
   * @return bool|\DateInterval
   * @throws \Exception
   * Retorna a idade da pessoa
   */
    public function getIdadePessoa($dtNascimento)
    {
      $dtNasc  = new \DateTime($dtNascimento);
      $dtAtual = new \DateTime();
      return $dtAtual->diff($dtNasc)->y;
    }


}
