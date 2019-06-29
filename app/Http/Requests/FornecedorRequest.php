<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          "nm_fornecedor" => "required|max:190",
          "nr_cpf_cnpj"   => "required",
          "nr_telefone"   => "required",
          "empresa_id"    => "required",
        ];
    }

    public function messages()
    {
      return [
        "nm_fornecedor.required" => "O Nome é obrigatório!",
        "nr_cpf_cnpj.required"   => "Nr. CPF/CNPJ é obrigatório!",
        "nr_telefone.required"   => "Nr. telefone é obrigatório!",
        "empresa_id.required"    => "Empresa é obrigatório!",
      ];
    }
}
