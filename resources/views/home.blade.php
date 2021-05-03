@extends('layouts.app')

@section('content')
@isset(currentUser()->id)
    <div class="row mb-4">
        <div class="col-md-8">
            <h4 class="mt-2"><b>LISTADO DE PRODUCTOS</b></h4>
        </div>
        <div class="col-md-4">
            <a href="{{ route('create') }}" class="btn btn-primary btn-lg float-lg-right float-md-right px-5">
                Añadir Producto
            </a>
        </div>
    </div>
@endisset

<Products/>

@endsection
