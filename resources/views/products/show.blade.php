@extends('layouts.app')

@section('content')
@if(isset($product))
<div class="row">
    <div class="col-md-5">
        <figure class="figure">
            <img src="data:image/jpeg;base64,{{ $product->photo }}" class="figure-img img-fluid rounded" alt="...">
            <figcaption class="figure-caption">{{ $product->name }}</figcaption>
        </figure>
        <a href="{{ url()->previous() }}" type="button" class="btn btn-warning btn-lg">Ir a la página anterior</a>
    </div>
    <div class="col-md-7 my-1">
        <div class="p-3 mb-4 bg-danger text-white"><h4>Ficha Técnica</h4></div>
        <table class="table table-bordered">
            <tbody>
              <tr>
                <th scope="row">Nombre</th>
                <td>{{ $product->name }}</td>
              </tr>
              <tr>
                <th scope="row">Descripción</th>
                <td>{{ $product->description }}</td>
              </tr>
              <tr>
                <th scope="row">Categoría</th>
                <td> {{ $product->category->name }} </td>
              </tr>
              <tr>
                <th scope="row">Precio</th>
                <td> $ {{ moneyFormat($product->price) }}</td>
              </tr>
              <tr>
                <th scope="row">Unidades Existentes</th>
                <td> {{ $product->quantity }}</td>
              </tr>
              <tr>
                <th scope="row">Fecha De Creación</th>
                <td> {{ date('Y/m/d H:s', strtotime($product->created_at )) }}</td>
              </tr>
              <tr>
                <th scope="row">Ultima Actualización</th>
                <td> {{ date('Y/m/d H:s', strtotime($product->created_at )) }}</td>
              </tr>
            </tbody>
          </table>
    </div>
</div>
@else
<div class="jumbotron">
    <h1 class="display-4">Ups, Lo sentimos!</h1>
    <p class="lead">La página que estas buscando no pudo ser encontrada.</p>
    <hr class="my-4">
    <h4 class="mb-4">404 not found</h4>
    <a class="btn btn-warning btn-lg" href=" @if(currentUser()->id) {{ route('home') }} @else {{ url('/') }} @endif" role="button">Ir al listado de productos</a>
  </div>
@endif


@endsection
