@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">categories</li>
@endsection

@section('content')

    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories._form')
    </form>

@endsection
