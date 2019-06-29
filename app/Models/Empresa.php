<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Support\Facades\DB;

  class Empresa extends Model
  {
    protected $fillable = [
      "nm_fantasia",
      "nr_cnpj",
      "estado_id"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Mapeamento da UF do Estado
     */
    public function estado()
    {
      return $this->belongsTo(Estado::class);
    }

    /**
     * @param $flEmpresa
     * @return Empresa[]|\Illuminate\Database\Eloquent\Collection
     * Retorna todas as Empresas ou uma em especifico
     */
    public function getEmpresa($flEmpresa)
    {
      if ($flEmpresa == null)
        return $this->all();
      else
        return $this->where('ds_uf', '=', $flEmpresa)
                    ->orWhere('nm_fantasia', 'LIKE', "%{$flEmpresa}%")
                    ->orWhere('nr_cnpj', 'LIKE', "%{$flEmpresa}%")->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Support\Collection
     * Retorna a UF do ID em especifico
     */
    public static function getUfEmpresa($id)
    {
      return DB::table('estados as e')
        ->join('empresas as em', 'em.estado_id', '=', 'e.id')
        ->select('ds_uf')
        ->where('em.id', '=', $id)
        ->first();
    }

  }