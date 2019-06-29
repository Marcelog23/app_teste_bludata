@extends('layouts.app')
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
            {!! Form::open(['name'=> 'form_search', 'route'=>'fornecedor']) !!}
            <div class="col-md-12">
              <div class="input-group input-group-sm mb-3">
                <input type="text" class="form-control" name="flFornecedor"
                       placeholder="Filtre por: Nome, CPF/CNPJ ou Dt. Cadastro" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-info" type="submit" name="search" id="button-addon2"><i
                      class="fa fa-search"></i> Filtrar
                  </button>
                </div>
              </div>
            </div>
            {!! Form::close() !!}
            <table class="table table-sm table-hover table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF/CNPJ</th>
                <th>Dt. Nascimento</th>
                <th>Telefone</th>
                <th>Ação</th>
              </tr>
              </thead>
              <tbody>
              @forelse($fornecedores as $fornecedor)
                <tr>
                  <td>{{$fornecedor->id}}</td>
                  <td>{{$fornecedor->nm_fornecedor}}</td>
                  <td>{{$fornecedor->nr_cpf_cnpj}}</td>
                  <td>{{$fornecedor->dt_nascimento}}</td>
                  <td>{{$fornecedor->nr_telefone}}</td>
                  <td>
                    <a href="{{route('fornecedor.edit', $fornecedor->id)}}"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-sm  btn-remove" data-id="{{$fornecedor->id}} "><i class="fa fa-trash"></i></a>
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
