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
        "dt_nascimento",
        'empresa_id',
    ];

  /**
   * @param $flFornecedor
   * @return Fornecedor[]|\Illuminate\Database\Eloquent\Collection
   * Retorna todos ou um Fornecedor em especifico
   */
    public function getFornecedor($flFornecedor)
    {
      if ($flFornecedor == null)
        return $this->all();
      else
        return $this->where('nm_fornecedor', 'LIKE', "%{$flFornecedor}%")
                    ->orWhere('nr_cpf_cnpj', '=', $flFornecedor)
                    ->orWhere('created_at', '=', $flFornecedor)->get();
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
