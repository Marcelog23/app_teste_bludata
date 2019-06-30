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
     * @param $value
     * Seta UpperCase no atributo Nome
     */
    public function setNmFantasiaAttribute($value)
    {
      $this->attributes["nm_fantasia"] = strtoupper($value);
    }

    /**
     * @param $value
     * Remove caracteres especiais Cnpj
     */
    public function setNrCnpjAttribute($value)
    {
      $this->attributes["nr_cnpj"] = preg_replace('/[^0-9]/', "", $value);
    }

    /**
     * @return string|string[]|null
     * Retorna Cnpj formatado
     */
    public function getNrCnpjFormattedAttribute()
    {
      $value = $this->nr_cnpj;
      if ($value)
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $value);
    }

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
        return $this->where('nm_fantasia', 'LIKE', "%{$flEmpresa}%")
                  ->orWhere('nr_cnpj',     'LIKE', "%{$flEmpresa}%")
               ->orWhereHas('estado', function ($query) use ($flEmpresa){
                      $query->where('estados.ds_uf', '=', "$flEmpresa");
                   })->get();
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