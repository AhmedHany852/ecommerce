@extends('layouts.dashboard')

@section('title', 'Stores')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Stores</li>
@endsection

@section('content')

    <div class="mb-5">

        <a href="{{ route('stores.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>

        {{-- <a href="{{ route('stores.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a> --}}
    </div>

    <x-alert type="success" />
    <x-alert type="info" />

    {{-- <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="inactive" @selected(request('status') == 'inactive')>inactive</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form> --}}

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Stores name</th>
                <th>slug</th>
                <th>description</th>
                <th>logo_image</th>
                <th>cover_image</th>
                <th>status</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($store as $storee)
                <tr>
                    <td><img src="{{ asset('storage/' . $storee->image) }}" alt="" height="50"></td>
                    <td>{{ $storee->id }}</td>
                    <td>{{ $storee->name }}</td>
                    <td>{{ $storee->slug }}</td>
                    <td>{{ $storee->description }}</td>
                    <td><img src="{{ asset('storage/' . $storee->logo_image) }}" alt="" height="50"></td>
                    <td><img src="{{ asset('storage/' . $storee->cover_image) }}" alt="" height="50"></td>
                    <td>{{ $storee->status }}</td>
                    <td>{{ $storee->created_at }}</td>
                    <td>{{ $storee->status }}</td>
                    <td>
                        <a href="{{ route('stores.edit', $storee->id) }}" class="btn btn-sm btn-outline-success">Edit</a>

                    </td>
                    <td>

                        <form action="{{ route('stores.destroy', $storee->id) }}" method="post">
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
                    <td colspan="9">No stores defined.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- {{ $stores->withQueryString()->appends(['search' => 1])->links() }} --}}

@endsection
