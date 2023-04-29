@extends('layouts.dashboard')

@section('title', 'product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">product</li>
@endsection

@section('content')

    <div class="mb-5">

        <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>

        {{-- <a href="{{ route('stores.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a> --}}
    </div>

    <x-alert type="success" />
    <x-alert type="info" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>name</th>
                <th>Category</th>
                <th>Store</th>
                <th>Status</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($datas as $dataa)
                <tr>
                    <td><img src="{{ asset($dataa->image) }}" alt="" height="50">
                    </td>
                    {{-- <img alt="user-avatar" class="img-circle img-fluid"  style=" width: 150px; " src="{{$dataa->image}}">    --}}
                    <td>{{ $dataa->id }}</td>
                    <td>{{ $dataa->name }}</td>
                    <td>{{ $dataa->category_id }}</td>
                    <td>{{ $dataa->store_id }}</td>
                    <td> {{ $dataa->status }}
                    <td>
                        <a href="{{ route('products.edit', $dataa->id) }}" class="btn btn-sm btn-outline-success">Edit</a>

                    </td>
                    <td>

                        <form action="{{ route('products.destroy', $dataa->id) }}" method="post">
                            @csrf
                            <!-- Form Method Spoofing -->
                            <input type="hidden" name="_method" value="delete">
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No products defined.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $datas->withQueryString()->appends(['search' => 1])->links() }}

@endsection
