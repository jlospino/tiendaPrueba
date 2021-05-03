@extends('layouts.app')

@section('content')
    <show-order v-bind:id="{{ $id }}" :key="{{ $id }}"/>
@endsection
