@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Karyawan</h2>

        <form id="editUserForm" action="{{ route('owner.employee.update', $employee->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">No Telp</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}" required>
            </div>

            <div class="mb-3">
                <label for="sallary" class="form-label">Gaji</label>
                <input type="number" class="form-control" id="sallary" name="sallary" value="{{ $employee->sallary }}" required>
            </div>

            <div class="mb-3">
                <label for="currentImage" class="form-label">KTP</label>
                @if ($employee->ktp)
                    <img id="currentImage" src="{{ asset('storage/' . $employee->ktp) }}" alt="Current KTP Image" style="max-width: 50%;">
                @endif
            </div>

            <img id="previewImage" src="#" alt="Preview Image" style="max-width: 50%; display: none;">
            <div class="mb-3">
                <label for="newKtp" class="form-label">Ganti KTP (Opsional)</label>
                <input type="file" class="form-control" id="newKtp" name="newKtp" accept="image/*">
            </div>

            <!-- Add more form fields as needed -->

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Listen for changes in the file input
            $('#newKtp').on('change', function() {
                // Get the selected file
                var file = this.files[0];

                if (file) {
                    // Hide the current image
                    $('#currentImage').hide();

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
