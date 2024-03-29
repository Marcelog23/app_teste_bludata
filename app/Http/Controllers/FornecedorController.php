<?php

  namespace App\Http\Controllers;

  use App\Http\Requests\FornecedorRequest;
  use App\Models\Empresa;
  use App\Models\Fornecedor;
  use Illuminate\Database\QueryException;
  use Illuminate\Http\Request;

  class FornecedorController extends Controller
  {
    private $Fornecedor;

    public function __construct(Fornecedor $Fornecedor)
    {
      $this->Fornecedor = $Fornecedor;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $fornecedores = $this->Fornecedor->getFornecedor($request->get('flFornecedor'),
                                                       $request->get('dtCadastro'),
                                                       $request->get('strFiltro'));
      return view('aplicacao.fornecedor.index', compact('fornecedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $empresas = Empresa::pluck('nm_fantasia', 'id');
      return view('aplicacao.fornecedor.create-edit', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(FornecedorRequest $request)
    {
      $data        = $request->all();
      $dsUf        = Empresa::getUfEmpresa($data["empresa_id"]);
      $idadePessoa = $this->Fornecedor->getIdadePessoa($data["dt_nascimento"]);

      if ($data["tipo_pessoa"] == "F" && $data["nr_rg"] == null && $data["dt_nascimento"] == null)
        return redirect()->back()->withErrors("Os campos, Nr. RG e Dt. Nascimento são obrigatórios");

      if ($data["tipo_pessoa"] == "F" && current($dsUf) == "PR" && $idadePessoa < 18 )
       return redirect()->back()->withErrors("Impossivel cadastrar uma Pessoa Física menor de 18 anos no estado do Paraná!");

      if (count($data))
      {
        $this->Fornecedor->create($data);
        return redirect()->route('fornecedor');
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
      $empresas   = Empresa::pluck('nm_fantasia', 'id');
      $fornecedor = $this->Fornecedor->findOrFail($id);
      if ($fornecedor)
        return view('aplicacao.fornecedor.create-edit', compact('fornecedor', 'empresas'));
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
    public function update(Request $request, $id)
    {
      $fornecedor = $this->Fornecedor->findOrFail($id);
      if (!$fornecedor)
        return redirect()->back();

      if ($fornecedor->update($request->all()))
        return redirect()->route('fornecedor');
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
        $fornecedor = $this->Fornecedor->findOrFail($id);
        if ($fornecedor->delete())
          return response()->json(['status' => 'success']);
      }catch(QueryException $e)
      {
        return response()->json('error', $e->getMessage());
      }
    }
  }