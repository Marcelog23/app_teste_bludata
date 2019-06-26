@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h5>Listagem de Empresas</h5>
              <div>
                <a href="{{route('empresa.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Cadastrar</a>
              </div>
            </div>
          </div>
          <div class="card-body">
              {!! Form::open(['name'=> 'form_search', 'route'=>'empresa']) !!}
            <div class="col-md-12">
              <div class="input-group input-group-sm mb-3">
                <input type="text" class="form-control" name="flEmpresa" placeholder="Filtre por: UF, Nome ou CNPJ" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-info" type="submit"  name="search" id="button-addon2"><i class="fa fa-search"></i> Filtrar</button>
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
                  <td>{{$empresa->ds_uf}}</td>
                  <td>{{$empresa->nm_fantasia}}</td>
                  <td>{{$empresa->nr_cnpj}}</td>
                  <td>
                    <a href="{{route('empresa.edit', $empresa->id)}}"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-sm  btn-remove" data-id="{{$empresa->id}} "><i class="fa fa-trash"></i></a>

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
           var routeDelete = "{{url('empresa')}}.destroy/"+id;
           // Swal.fire({
           //     type: 'error',
           //     title: 'Exclusão de Empresa!',
           //     confirmButtonClass: "btn-danger",
           //     confirmButtonText: "Sim",
           //     showCancelButton: true,
           //     cancelButtonText: "Não",
           //     footer: 'O registro será removido permanentemente!',
           // }).then((result) =>{
           //    if (result.value){
           //        console.log(value);
           //    }
           // });


           Swal.fire({
               title: 'Are you sure?',
               text: "You won't be able to revert this!",
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, delete it!'
           }).then((result) => {
               if (result.value) {
                   Swal.fire(
                       'Deleted!',
                       'Your file has been deleted.',
                       'success'
                   )
               }
           });


       });

});
  </script>
@endsection
