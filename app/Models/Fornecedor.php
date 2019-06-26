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

    public function getFornecedor($flFornecedor)
    {
      if ($flFornecedor == null)
        return $this->all();
      else
        return $this->where('nm_fornecedor', 'LIKE', "&{$flFornecedor}&")
                    ->orWhere('nr_cpf_cnpj', '=', $flFornecedor)
                    ->orWhere('created_at', '=', $flFornecedor)->get();
    }


}
