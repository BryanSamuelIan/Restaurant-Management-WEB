@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    @if ($category == 'alcohol')
                        <th>Alcohol%</th>
                        <th>Stok</th>
                    @endif
                    <th>Harga</th>
                    @if ($category == 'alcohol')
                        <th>Supplier</th>
                    @endif
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->category->name }}</td>
                        <td>{{ $menu->description }}</td>
                        @if ($category == 'alcohol')
                            <td>{{ $menu->{'alcohol%'} }}</td>
                            <td>{{ $menu->stock }}</td>
                        @endif
                        <td>Rp{{ number_format($menu->price, 0, ',', '.') }}</td>
                        @if ($category == 'alcohol')
                            <td>{{ $menu->supplier->name }}</td>
                        @endif
                        <td>

                            @if (Auth::user()->isAdmin())
                            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            @endauth
                            @if (Auth::user()->isOwner())
                            <a href="{{ route('owner.menu.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('owner.menu.destroy', $menu->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            @endauth

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
