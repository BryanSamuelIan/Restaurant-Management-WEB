@extends('layouts.app') <!-- Assuming you have a layout file, adjust as needed -->

@section('content')
    <div class="container">
        <h2>Edit Supplier</h2>
        @if (Auth::user()->isAdmin())
            <form action="{{ route('admin.supplier.update', ['id' => $supplier->id]) }}" method="post">
            @elseif (Auth::user()->isOwner())
                <form action="{{ route('owner.supplier.update', ['id' => $supplier->id]) }}" method="post">
        @endif
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Supplier</label>
            <input type="text" class="form-control" value="{{ $supplier->name }}" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat Supplier</label>
            <input type="text" class="form-control" id="address" value="{{ $supplier->address }}" name="address" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control"  value="{{ $supplier->phone }}" id="phone" name="phone" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Supplier</label>
            <input type="email" class="form-control" value="{{ $supplier->email }}" id="email" name="email">
        </div>

        <button type="submit" class="btn btn-primary">Edit Supplier</button>
        </form>
    </div>
@endsection
