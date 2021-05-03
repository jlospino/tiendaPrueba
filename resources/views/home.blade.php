@extends('layouts.app')

@section('content')
@isset(currentUser()->id)
    <div class="row mb-4">
        <div class="col-md-8">
            <h4>Listado de productos</h4>
        </div>
        <div class="col-md-4">
            <a href="{{ route('create') }}" class="btn btn-primary btn-lg float-lg-right float-md-right">
                Añadir Producto
            </a>
        </div>
    </div>
@endisset

<Products/>

@endsection
