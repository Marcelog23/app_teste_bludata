<?php

  namespace App\Http\Requests;

  use Illuminate\Foundation\Http\FormRequest;

  class EmpresaRequest extends FormRequest
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
      $id = $this->route('id');
      return [
        "nm_fantasia" => "required|max:190",
        "nr_cnpj"     => "required"
      ];
    }

    public function messages()
    {
      return [
        "nm_fantasia.required" => "Nome Fantasia é obrigatório!",
        "nr_cnpj.required"     => "Nr. CNPJ é obrigatório!"
      ];
    }
  }
