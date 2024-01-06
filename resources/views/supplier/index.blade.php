@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->email }}</td>

                    @if (Auth::user()->isOwner())
                    <td>
                        <a href="{{ route('owner.supplier.edit', ['id' => $supplier->id]) }}"
                            class="btn btn-primary">Edit</a>

                        <a href="{{ route('owner.supplier.destroy', ['id' => $supplier->id]) }}"
                            class="btn btn-danger">Delete</a>
                    </td>
                @else(Auth::user()->isAdmin())
                    <td>
                        <a href="{{ route('admin.supplier.edit', ['id' => $supplier->id]) }}"
                            class="btn btn-primary">Edit</a>



                        <form action="{{ route('admin.supplier.destroy', $supplier['id']) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger" id="delete"
                                name="delete">Delete</button>
                        </form>

                    </td>
                @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
