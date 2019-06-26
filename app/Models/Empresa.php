<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;

  class Empresa extends Model
  {
    protected $fillable = [
      "ds_uf",
      "nm_fantasia",
      "nr_cnpj"
    ];

    public function uf_estados()
    {
      return $siglas = [
        ["value" => 'AC', "descricao" => 'AC'],
        ["value" => 'AL', "descricao" => 'AL'],
        ["value" => 'AM', "descricao" => 'AM'],
        ["value" => 'AP', "descricao" => 'AP'],
        ["value" => 'BA', "descricao" => 'BA'],
        ["value" => 'CE', "descricao" => 'CE'],
        ["value" => 'DF', "descricao" => 'DF'],
        ["value" => 'ES', "descricao" => 'ES'],
        ["value" => 'GO', "descricao" => 'GO'],
        ["value" => 'MA', "descricao" => 'MA'],
        ["value" => 'MG', "descricao" => 'MG'],
        ["value" => 'MS', "descricao" => 'MS'],
        ["value" => 'MT', "descricao" => 'MT'],
        ["value" => 'PA', "descricao" => 'PA'],
        ["value" => 'PB', "descricao" => 'PB'],
        ["value" => 'PE', "descricao" => 'PE'],
        ["value" => 'PI', "descricao" => 'PI'],
        ["value" => 'PR', "descricao" => 'PR'],
        ["value" => 'RJ', "descricao" => 'RJ'],
        ["value" => 'RN', "descricao" => 'RN'],
        ["value" => 'RO', "descricao" => 'RO'],
        ["value" => 'RR', "descricao" => 'RR'],
        ["value" => 'RS', "descricao" => 'RS'],
        ["value" => 'SC', "descricao" => 'SC'],
        ["value" => 'SE', "descricao" => 'SE'],
        ["value" => 'SP', "descricao" => 'SP'],
        ["value" => 'TO', "descricao" => 'TO'],
      ];
    }


    public function getEmpresa($flEmpresa)
    {
      if ($flEmpresa == null)
        return $this->all();
      else
        return $this->where('ds_uf', '=', $flEmpresa)
                    ->orWhere('nm_fantasia', 'LIKE', "%{$flEmpresa}%")
                    ->orWhere('nr_cnpj', 'LIKE', "%{$flEmpresa}%")->get();
    }



  }
