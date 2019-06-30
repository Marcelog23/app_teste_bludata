@extends('home')
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
              {!! Form::model($fornecedor,['route'=>['fornecedor.update', $fornecedor->id], 'class'=>'form form-search form-ds', 'id' => 'formFornecedor', 'method'=>'PUT']) !!}
            @else
              {!! Form::open(['route'=>'fornecedor.store', 'class'=>'form form-search form-ds', 'id' => 'formFornecedor']) !!}
            @endif

            <div class="row">
              {!! Form::hidden('dt_cadastro',date("Y-m-d"),['class'=>'form-control']) !!}
              <div class="form-group col-md-2 input-group-sm ">
                <label for="tipo_pessoa">Tipo Pessoa</label>
                {!! Form::select('tipo_pessoa', ['J' => 'Jurídica', 'F' => 'Física'], null, ['class'=>'form-control', 'placeholder' => 'Selecione', 'id' => 'tipo_pessoa']) !!}
              </div>
            </div>

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
                {!! Form::text('nr_telefone',null,['class'=>'form-control', 'id' => 'nr_telefone']) !!}
              </div>
              <div class="form-group input-group-sm col-md-6">
                <label for="nr_cpf_cnpj">CPF/CNPJ</label>
                {!! Form::text('nr_cpf_cnpj',null,['class'=>'form-control', 'id' => 'nr_cpf_cnpj']) !!}
              </div>
            </div>
            <div class="row" id="dadosPessoaFisica" style="display: none">
              <div class="form-group input-group-sm col-md-6">
                <label for="nr_rg">RG</label>
                {!! Form::text('nr_rg',null,['class'=>'form-control', 'id' => 'nr_rg']) !!}
              </div>
              <div class="form-group input-group-sm col-md-6">
                <label for="dt_nascimento">Dt. Nascimento</label>
                {!! Form::date('dt_nascimento',null,['class'=>'form-control', 'id' => 'dt_nascimento']) !!}
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

      $('.empresa_id').select2();

      $('#tipo_pessoa').on('change', function () {
        if ($(this).val() === 'F')
        {
          $('#dadosPessoaFisica').show();
          $('#nr_rg').addClass('required');
          $('#dt_nascimento').addClass('required');
        }
        else
          $('#dadosPessoaFisica').hide();
      });

      var phoneMask = IMask(
        document.getElementById('nr_telefone'), {
          mask: [
            {
              mask: '(00)0000-0000',
              maxLength: 13
            },
            {
              mask: '(00)0.0000-0000'
            }
          ]
        });


      var maskCpfOuCnpj = IMask(document.getElementById('nr_cpf_cnpj'), {
        mask:[
          {
            mask: '000.000.000-00',
            maxLength: 11
          },
          {
            mask: '00.000.000/0000-00'
          }
        ]
      });

      var maskRg = IMask(document.getElementById('nr_rg'), {
        mask: '00000000-00'
      });

      @if($errors->count() > 0)
        Swal.fire({
          title:'Erro!',
          type:'error',
          html: "@foreach($errors->all() as $error)\n" +
            "<div class='text-center'>{{$error}}</div>" +
            "@endforeach"
        });
      @endif

    });
  </script>
@endsection