@extends('layouts.dashboard')

@section('title', 'create Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Products</li>
    <li class="breadcrumb-item active">Create Product</li>
@endsection

@section('content')

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf


        @include('dashboard.products._form')
    </form>

@endsection
