@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Phone Number</th>
                <th>Gaji</th>
                <th>KTP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->phone }}</td>    
                    <td>{{ $employee->sallary }}</td>
                    <td>
                        @if ($employee->ktp)
                            <img src="{{ asset('storage/' . $employee->ktp) }}" alt="KTP Image" style="max-width: 100px; max-height: 100px;">
                        @else
                            Tidak ada ktp
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>    
</div>

@endsection
