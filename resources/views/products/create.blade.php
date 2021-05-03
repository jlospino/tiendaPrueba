@extends('layouts.app')
@section('content')
<h4>Registrar Producto</h4>

@isset($error)
    <div class="alert alert-danger" role="alert">
        {{$error}}
    </div>
@endisset
<form action="{{ route('store') }}" method="POST" class="my-4" enctype="multipart/form-data">
    {{ csrf_field() }}
    @include('products.fields')
</form>
@endsection
