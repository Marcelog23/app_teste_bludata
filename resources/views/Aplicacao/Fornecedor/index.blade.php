@extends('home')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h5>Listagem de Fornecedores</h5>
              <div>
                <a href="{{route('fornecedor.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>
                  Cadastrar</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="mb-2">
              {!! Form::open(['name'=> 'form_search', 'route'=>'fornecedor']) !!}
                <div style="display: flex; justify-content: center; align-items: center ">
                  <div class="col-md-6">
                    <div class="form-group input-group-sm">
                      <label for="flFornecedor">Filtre por: Nome ou CPF/CNPJ</label>
                      {!! Form::text('flFornecedor', null, ['class' => 'form-control input-group-sm']) !!}
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group input-group-sm">
                      <label for="dtCadastro">Dt. Cadastro</label>
                      {!! Form::date('dtCadastro', null, ['class'=> 'form-control']) !!}
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group input-group-sm">
                      <label for="strFiltro">Operação</label>
                      {!! Form::select('strFiltro', ['=' => 'Igual' , '<' => 'Menor', '>' => 'Maior' ], null, ['class'=> 'form-control', 'placeholder' => 'Selecione']) !!}
                    </div>
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-info btn-sm text-white" type="submit" name="search" id="button-addon2"><i
                        class="fa fa-search"></i> Filtrar
                    </button>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
            <table class="table table-sm table-hover table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF/CNPJ</th>
                <th>Telefone</th>
                <th>Dt. Cadastro</th>
                <th>Ação</th>
              </tr>
              </thead>
              <tbody>
              @forelse($fornecedores as $fornecedor)
                <tr>
                  <td>{{$fornecedor->id}}</td>
                  <td>{{$fornecedor->nm_fornecedor}}</td>
                  <td>{{$fornecedor->nr_cpf_cnpj_formatted}}</td>
                  <td>{{$fornecedor->nr_telefone}}</td>
                  <td>{{\Carbon\Carbon::parse($fornecedor->dt_cadastro)->format("d/m/Y")}}</td>
                  <td>
                    <a href="{{route('fornecedor.edit', $fornecedor->id)}}"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-sm  btn-remove" data-id="{{$fornecedor->id}}"><i class="fa fa-trash-alt"></i></a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="100">Não há registros</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script>
    $(document).ready(function () {

      $('.btn-remove').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
          title: 'Exclusão de Fornecedor',
          text: "Deseja realmente excluir?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sim',
          cancelButtonText: 'Não'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              type: 'GET',
               url: 'fornecedor/' + id + '/destroy',
            }).done(function (data) {
              if (data.status === 'success') {
                Swal.fire({
                  title: 'Removido!',
                   text: 'Registro removido com sucesso',
                   type: 'success'
                }).then(function () {
                  location.reload();
                });
              } else {
                Swal.fire({
                  title: 'Atenção!',
                   text: 'Registro está sendo usado, por isso não pode ser removido! ',
                   type: 'warning'
                });
              }
            });
          }
        })
      });
    });
  </script>
@endsection