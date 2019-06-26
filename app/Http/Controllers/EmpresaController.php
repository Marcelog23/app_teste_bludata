<?php

  namespace App\Http\Controllers;

  use App\Models\Empresa;
  use Illuminate\Database\QueryException;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\DB;

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
      $siglas = $this->Empresa->uf_estados();
      return view('aplicacao.empresa.create-edit', compact('siglas'));
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
        $this->Empresa->create($data);
        return redirect()->route('empresa');
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
      $siglas  = $this->Empresa->uf_estados();
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
    public function update(Request $request, $id)
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
        //return redirect()->route('empresa.index');
        return response()->json('success');
      }
      catch (QueryException $e)
      {
        return redirect()->back()->with($e->getMessage());
      }
    }

    public function getUfEmpresa($id)
    {
      return DB::table('empresas as e')
                  ->select('ds_uf')
                  ->where('e.id', '=', $id)
                  ->get();
    }



  }
