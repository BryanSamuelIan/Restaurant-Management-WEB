<!-- resources/views/users/create.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file, adjust as needed -->

@section('content')
    <div class="container">
        <h2>Tambah User Baru</h2>

        <form id="createUserForm" action="{{ route('owner.user.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select class="form-select" name="role_id" id="role_id" required>
                    <option value="">Pilih role</option> <!-- Default option with no value -->
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="employee_id" class="form-label">Employee</label>
                <select class="form-select" name="employee_id" id="employee_id" required>
                    <option value="">Pilih karyawan yang tersedia</option> <!-- Default option with no value -->
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Add more form fields as needed -->

            <button type="submit" class="btn btn-primary">Tambah User</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
    $('#createUserForm').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append('_token', '{{ csrf_token() }}'); // Include CSRF token

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success
                alert('User has been created successfully!');
                $('#createUserForm')[0].reset();
                window.location.href = '{{ route('owner.users') }}';
            },
            error: function(error) {
                // Handle errors
                console.error('Error creating user:', error);
                alert('Error creating user. Please try again.');
            }
        });
    });
});
    </script>
@endsection
