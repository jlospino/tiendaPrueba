@extends('layouts.app')
@section('content')
<h4>Editar Producto ({{ $product->name }})</h4>
@isset($error)
    <div class="alert alert-danger" role="alert">
        {{$error}}
    </div>
@endisset
<form action="{{ route('update') }}" method="POST" class="my-4" enctype="multipart/form-data">
    {{ csrf_field() }}
    @include('products.fields')
</form>
@endsection
