@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Banner</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>
                        <img src="{{ asset('storage/'.$event->banner) }}" alt="Event Banner" width="100" height="100">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
