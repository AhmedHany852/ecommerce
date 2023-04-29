@extends('layouts.dashboard')

@section('title', 'Create Role')


@parent
<li class="breadcrumb-item active">Roles</li>


@section('content')

    <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.roles._form')
    </form>

@endsection
