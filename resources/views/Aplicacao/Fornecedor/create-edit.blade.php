@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h5>Cadastro de Fornecedor</h5>
            </div>
          </div>
          <div class="card-body">
            @if(isset($fornecedor))
              {!! Form::model($fornecedor,['route'=>['fornecedor.update', $fornecedor->id], 'class'=>'form form-search form-ds', 'method'=>'PUT']) !!}
            @else
              {!! Form::open(['route'=>'fornecedor.store', 'class'=>'form form-search form-ds']) !!}
            @endif
            <div class="row">
              <div class="form-group col-md-6 input-group-sm ">
                <label for="empresa_id">Empresa</label>
                {!! Form::select('empresa_id', $empresas, null, ['class'=>'form-control empresa_id']) !!}
              </div>
              <div class="form-group input-group-sm col-md-6">
                <label for="nm_fornecedor">Nome Fornecedor</label>
                {!! Form::text('nm_fornecedor',null,['class'=>'form-control']) !!}
              </div>
            </div>
            <div class="row">
              <div class="form-group input-group-sm col-md-6">
                <label for="nr_telefone">Telefone</label>
                {!! Form::text('nr_telefone',null,['class'=>'form-control']) !!}
              </div>
              <div class="form-group input-group-sm col-md-6">
                <label for="nr_cpf_cnpj">CPF/CNPJ</label>
                {!! Form::text('nr_cpf_cnpj',null,['class'=>'form-control cpfOuCnpj']) !!}
              </div>
            </div>
            <div class="row">
              <div class="form-group input-group-sm col-md-6">
                <label for="nr_rg">RG</label>
                {!! Form::text('nr_rg',null,['class'=>'form-control']) !!}
              </div>
              <div class="form-group input-group-sm col-md-6">
                <label for="dt_nascimento">Dt. Nascimento</label>
                {!! Form::date('dt_nascimento',null,['class'=>'form-control']) !!}
              </div>
            </div>

            <div class=" box-footer ">
              <div style="float: left">
                <a href="{{route('fornecedor')}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
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
@section('script')
  <script>
    $(document).ready(function () {
      /*
        var options = {
            onKeyPress: function (cpf, ev, el, op) {
                var masks = ['000.000.000-000', '00.000.000/0000-00'];
                $('.cpfOuCnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
            }
        };

        $('.cpfOuCnpj').length > 11 ? $('.cpfOuCnpj').mask('00.000.000/0000-00', options) : $('.cpfOuCnpj').mask('000.000.000-00#', options);
      */

        $(".cpfOuCnpj").keypress(function(){
            $(".cpfOuCnpj").unmask();
            var tamanho = $(".cpfOuCnpj").val().length;

            if(tamanho == 11){
                $(".cpfOuCnpj").mask("999.999.99-99");
            } else if(tamanho == 14){
                $(".cpfOuCnpj").mask("99.999.999/9999-99");
            }
        });



        $('.empresa_id').on('change', function () {
           $.get($(this).val()+'/getUF' , function (data) {
              console.log(data[0]);
           });
        });
    });
  </script>
@endsection