@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Employee ID</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->employee_id }}</td>
                        <td>
                            <button
                                class="active-status btn @if ($user->is_active) btn-success @else btn-danger @endif"
                                data-user-id="{{ $user->id }}" data-active="{{ $user->is_active ? 'true' : 'false' }}">
                                {{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-primary change-password" data-user-id="{{ $user->id }}"
                                data-username="{{ $user->name }}">
                                Ubah Password
                            </button>
                            <form action="{{ route('owner.user.destroy', $user['id']) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" id="delete"
                                    name="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Password Change Modal -->
    <div class="modal fade" id="passwordChangeModal" tabindex="-1" role="dialog" aria-labelledby="passwordChangeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordChangeModalLabel">Ubah Password untuk <span
                            id="modalUsername"></span></h5>
                </div>
                <div class="modal-body">
                    <form id="passwordChangeForm">
                        <div class="form-group mb-2">
                            <label for="newPassword">Password Baru</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <input type="hidden" id="userId" name="userId">
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Handle click on "Active" button
            $('#myTable').on('click', '.active-status', function() {
                const button = $(this);
                const userId = button.data('user-id');
                const isActive = button.data('active') === 'true';

                $.ajax({
                    method: 'PUT',
                    url: `/owner/users/${userId}/update-active-status`,
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

            // Handle click on "Change Password"
            $('#myTable').on('click', '.change-password', function(e) {
                e.preventDefault();
                const userId = $(this).data('user-id');
                const username = $(this).data('username');

                $('#modalUsername').text(username);
                $('#userId').val(userId);
                $('#passwordChangeModal').modal('show');
            });

            // Handle form submission for changing password
            $('#passwordChangeForm').submit(function(e) {
                e.preventDefault();
                const userId = $('#userId').val();
                const newPassword = $('#newPassword').val();

                $.ajax({
                    method: 'PUT',
                    url: `/owner/users/${userId}/update-password`,
                    data: {
                        _token: '{{ csrf_token() }}',
                        new_password: newPassword,
                    },
                    success: function(response) {
                        $('#passwordChangeModal').modal('hide');
                    },
                    error: function(error) {
                        console.error(error);
                    },
                });
            });
        });
    </script>
@endsection
