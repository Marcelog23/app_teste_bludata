@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    Bem Vindo ao Sistema.
                  @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
