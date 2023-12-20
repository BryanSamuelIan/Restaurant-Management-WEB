<!-- resources/views/users/create.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file, adjust as needed -->

@section('content')
    <div class="container">
        <h2>Tambah Karyawan Baru</h2>

        <form id="createUserForm" action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">No Telp</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="mb-3">
                <label for="sallary" class="form-label">Gaji</label>
                <input type="number" class="form-control" id="sallary" name="sallary" required>
            </div>
            <img id="previewImage" src="#" alt="Preview Image" style="max-width: 50%; display: none;">
            <div class="mb-3">
                <label for="ktp" class="form-label">KTP</label>
                <input type="file" class="form-control" id="ktp" name="ktp" accept="image/*" required>
            </div>

            <!-- Add more form fields as needed -->

            <button type="submit" class="btn btn-primary">Tambah Karyawan</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Listen for changes in the file input
            $('#ktp').on('change', function() {
                // Get the selected file
                var file = this.files[0];

                if (file) {
                    // Create a FileReader to read the file
                    var reader = new FileReader();

                    // Set a callback function to handle the file reading
                    reader.onload = function(e) {
                        // Set the source of the preview image
                        $('#previewImage').attr('src', e.target.result);

                        // Show the preview image
                        $('#previewImage').show();
                    };

                    // Read the file as a data URL
                    reader.readAsDataURL(file);
                } else {
                    // If no file is selected, hide the preview image
                    $('#previewImage').hide();
                }
            });
        });
    </script>
@endsection
