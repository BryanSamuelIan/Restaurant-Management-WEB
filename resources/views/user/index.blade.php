@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role->name }}</td>
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
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                </div>
                <div class="modal-body">
                    <!-- Add your form elements for changing the password here -->
                    <form id="passwordChangeForm">
                        <div class="form-group mb-2">
                            <label for="newPassword">Password Baru</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <input type="hidden" id="userId" name="userId" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').on('click', '.active-status', function() {
                const userId = $(this).data('user-id');
                const isActive = $(this).data('active') === 'true';

                // Perform an AJAX request to update the is_active status
                $.ajax({
                    method: 'PUT',
                    url: `/admin/users/${userId}/update-active-status`,
                    data: {
                        _token: '{{ csrf_token() }}',
                        is_active: !isActive,
                    },
                    success: function(response) {
                        // Update the displayed status
                        const buttonText = response.is_active ? 'Aktif' : 'Tidak Aktif';
                        const buttonClass = response.is_active ? 'btn-success' : 'btn-danger';

                        $(`.active-status[data-user-id="${userId}"]`)
                            .removeClass('btn-success btn-danger')
                            .addClass(buttonClass)
                            .text(buttonText);
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

                // Set the username in the modal
                $('#modalUsername').text(username);

                // Set the userId in the hidden input field
                $('#passwordChangeModal').find('#userId').val(userId);

                // Show the password change modal
                $('#passwordChangeModal').modal('show');
            });

            // Handle form submission for changing password
            $('#passwordChangeForm').submit(function(e) {
                e.preventDefault();
                const userId = $(this).find('#userId').val();
                const newPassword = $(this).find('#newPassword').val();

                // Perform an AJAX request to update the password
                $.ajax({
                    method: 'PUT',
                    url: `/admin/users/${userId}/update-password`,
                    data: {
                        _token: '{{ csrf_token() }}',
                        new_password: newPassword,
                    },
                    success: function(response) {
                        // You can add further handling, e.g., show a success message
                        console.log(response);
                        // Close the modal after successful password change
                        $('#passwordChangeModal').modal('hide');
                    },
                    error: function(error) {
                        console.error(error);
                        // You can handle errors here, e.g., show an error message
                    },
                });
            });
        });
    </script>
@endsection
