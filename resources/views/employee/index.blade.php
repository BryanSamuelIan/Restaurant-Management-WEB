@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Phone Number</th>
                <th>Gaji</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->phone }}</td>    
                    <td>{{ $employee->sallary }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>    
</div>

@endsection
