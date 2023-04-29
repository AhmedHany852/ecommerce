@extends('layouts.dashboard')

@section('title', 'stores')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">store</li>
@endsection

@section('content')

    <form action="{{ route('stores.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.stores._form')
    </form>

@endsection
