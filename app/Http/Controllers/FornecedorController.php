<?php

  namespace App\Http\Controllers;

  use App\Models\Empresa;
  use App\Models\Fornecedor;
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $fornecedores = $this->Fornecedor->getFornecedor($request->get('flFornecedor'));
      return view('aplicacao.fornecedor.index', compact('fornecedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $empresas = Empresa::pluck('nm_fantasia', 'id')->prepend('Selecione');
      return view('aplicacao.fornecedor.create-edit', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->all();
      if (count($data))
      {
        $this->Fornecedor->create($data);
        return redirect()->route('fornecedor');
      }
      else
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $empresas   = Empresa::pluck('nm_fantasia', 'id')->prepend('Selecione');
      $fornecedor = $this->Fornecedor->findOrFail($id);
      if ($fornecedor)
        return view('aplicacao.create-edit', compact('fornecedor', 'empresas'));
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
      //
    }
  }
