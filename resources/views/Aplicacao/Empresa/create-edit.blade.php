@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h5>Cadastro de Empresa</h5>
            </div>
          </div>
          <div class="card-body">


            @if(isset($empresa))
              {!! Form::model($empresa,['route'=>['empresa.update', $empresa->id], 'class'=>'form form-search form-ds', 'method'=>'PUT']) !!}
            @else
              {!! Form::open(['route'=>'empresa.store', 'class'=>'form form-search form-ds']) !!}
            @endif
            <div class="row">
              <div class="form-group col-md-4 input-group-sm ">
                <label for="ds_uf">UF</label>

                  {!! Form::select('estado_id', $siglas, null, ['class'=> 'form-control select2']) !!}


              </div>
              <div class="form-group input-group-sm col-md-8">
                <label for="nm_fantasia">Nome Fantasia</label>
                {!! Form::text('nm_fantasia',null,['class'=>'form-control']) !!}
              </div>
            </div>
            <div class="row">
              <div class="form-group input-group-sm col-md-6">
                <label for="nr_cnpj">CNPJ</label>
                {!! Form::text('nr_cnpj',null,['class'=>'form-control']) !!}
              </div>
            </div>
            <div class=" box-footer ">
              <div style="float: left">
                <a href="{{route('empresa')}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
                  Cancelar</a>
              </div>
              <div style="float: right">
                <button type="submit" class="btn btn-primary btn-light-blue btn-sm"><i class="fa fa-check"></i>
                  Confirmar
                </button>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section("script")
  <script>
    @if($errors->count() > 0)
      Swal.fire({
        title:'Erro!',
        type:'error',
        html: "@foreach($errors->all() as $error)\n" +
                "<div class='text-center'>{{$error}}</div>" +
              "@endforeach"
      });
    @endif
  </script>
@endsection