@extends('layouts.dashboard')

@section('title', 'Edit stores')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">stores</li>
    <li class="breadcrumb-item active">Edit stores</li>
@endsection

@section('content')

    <form action="{{ route('stores.update', $store->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('dashboard.stores._form', [])
    </form>

@endsection
