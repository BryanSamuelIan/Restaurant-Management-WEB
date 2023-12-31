@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="table-responsive">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Phone Number</th>
                    <th>Gaji</th>
                    <th>KTP</th>
                    <th>Status</th>
                    <th>Actions</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->sallary }}</td>
                        <td>
                            <button
                                class="active-status btn @if ($employee->is_active) btn-success @else btn-danger @endif"
                                data-employee-id="{{ $employee->id }}"
                                data-active="{{ $employee->is_active ? 'true' : 'false' }}">
                                {{ $employee->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </button>
                        </td>
                        <td>
                            @if ($employee->ktp)
                                <img src="{{ asset('storage/' . $employee->ktp) }}" alt="KTP Image"
                                    style="max-width: 100px; max-height: 100px;">
                            @else
                                Tidak ada ktp
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('owner.employee.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('owner.employee.destroy', $employee->id) }}" method="post"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>


    <script>
        $(document).ready(function() {
    // Handle click on "Active" button
    $('#myTable').on('click', '.active-status', function(event) {
        event.preventDefault(); // Prevent default form submission if it's a button within a form

        const button = $(this);
        const employeeId = button.data('employee-id');
        const isActive = button.data('active') === 'true';

        $.ajax({
            method: 'PUT',
            url: `/owner/employees/${employeeId}/update-active-status`,
            data: {
                _token: '{{ csrf_token() }}',
                is_active: !isActive,
            },
            success: function(response) {
                const buttonText = response.is_active ? 'Aktif' : 'Tidak Aktif';
                const buttonClass = response.is_active ? 'btn-success' : 'btn-danger';

                button.removeClass('btn-success btn-danger')
                    .addClass(buttonClass)
                    .text(buttonText)
                    .data('active', response.is_active.toString());
            },
            error: function(error) {
                console.error(error);
            },
        });
    });
});

    </script>
@endsection
