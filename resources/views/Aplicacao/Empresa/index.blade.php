@extends('.home')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h5>Listagem de Empresas</h5>
              <div>
                <a href="{{route('empresa.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>
                  Cadastrar</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            {!! Form::open(['name'=> 'form_search', 'route'=>'empresa']) !!}
            <div class="row">
              <div class="col-md-12">
                <label for="">Filtre por: UF, Nome ou CNPJ</label>
                <div class="input-group input-group-sm mb-3">
                  <input type="text" class="form-control" name="flEmpresa"
                         aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-info text-white" type="submit" name="search" id="button-addon2"><i
                        class="fa fa-search"></i> Filtrar
                    </button>
                  </div>
                </div>
              </div>
            </div>
            {!! Form::close() !!}
            <table class="table table-sm table-hover table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>UF</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Ação</th>
              </tr>
              </thead>
              <tbody>
              @forelse($empresas as $empresa)
                <tr>
                  <td>{{$empresa->id}}</td>
                  <td>{{$empresa->estado->ds_uf}}</td>
                  <td>{{$empresa->nm_fantasia}}</td>
                  <td>{{$empresa->nr_cnpj_formatted}}</td>
                  <td>
                    <a href="{{route('empresa.edit', $empresa->id)}}"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-sm  btn-remove" data-id="{{$empresa->id}} "><i class="fa fa-trash-alt"></i></a>
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
          title: 'Exclusão da Empresa',
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
              url: 'empresa/' + id + '/destroy',
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