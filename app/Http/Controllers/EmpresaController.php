<?php

  namespace App\Http\Controllers;

  use App\Http\Requests\EmpresaRequest;
  use App\Models\Empresa;
  use App\Models\Estado;
  use Illuminate\Http\Request;

  class EmpresaController extends Controller
  {
    private $Empresa;

    public function __construct(Empresa $Empresa)
    {
      $this->Empresa = $Empresa;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $empresas = $this->Empresa->getEmpresa($request->get('flEmpresa'));
      return view('aplicacao.empresa.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $siglas = Estado::pluck("ds_uf", "id");
      return view('aplicacao.empresa.create-edit', compact('siglas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request)
    {
      $data = $request->all();
      if (count($data))
      {
        $this->Empresa->create($data);
        return redirect()->route('empresa');
      }
      else
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $siglas  = Estado::pluck("ds_uf", "id");
      $empresa = $this->Empresa->findOrfail($id);
      if (isset($empresa))
        return view('aplicacao.empresa.create-edit', compact('empresa', 'siglas'));
      else
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaRequest $request, $id)
    {
      if (!$empresa = $this->Empresa->findOrFail($id))
        return redirect()->back();

      if ($empresa->update($request->all()))
        return redirect()->route('empresa');
      else
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try
      {
        $empresa = $this->Empresa->findOrFail($id);
        $empresa->delete();
        return response()->json(['status' => 'success']);
      }
      catch (\Exception $e)
      {
        return response()->json(['error' => $e->getMessage()]);
      }
    }

    /**
     * @param $id
     * @return \Illuminate\Support\Collection
     * Retorna a UF da Empresa, pelo ID informado
     */
    public function getUfEmpresa($id)
    {
      return $this->Empresa->getUfEmpresa($id);
    }
  }