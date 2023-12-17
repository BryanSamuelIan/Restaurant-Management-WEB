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
                @endif
                    <th>Harga</th>
                    @if ($category == 'alcohol')
                        <th>Supplier</th>
                    @endif
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
                        @endif
                        <td>{{ $menu->price }}</td>
                        @if ($category == 'alcohol')
                            <td>{{ $menu->supplier->name }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
