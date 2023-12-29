@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Edit Event</h2>

        @if (Auth::user()->isOwner())
            <form id="createEventForm" action="{{ route('owner.event.update', $eventEdit['id']) }}" method="post"enctype="multipart/form-data">
            @elseif (Auth::user()->isAdmin())
            <form id="createEventForm" action="{{ route('admin.event.update', $eventEdit['id']) }}" method="post" enctype="multipart/form-data">
        @endif
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Event name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $eventEdit->name }}" required>
        </div>

        <div class="mb-3">
            <label for="is_active" class="form-label">Is active?</label>
            <select class="form-select" name="is_active" id="is_active">
                @if ($eventEdit->is_active == 1)
                    <option value="1" selected>Active</option>
                    <option value="0">Not Active</option>
                @else
                    <option value="1">Active</option>
                    <option value="0" selected>Not Active</option>
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="banner" class="form-label">Upload Image</label>
            <br>
            <img src="{{ asset('storage/' . $eventEdit->banner) }}" alt="{{ $eventEdit->name }}" class="img-preview img-fluid mb-3 col-sm-5" style="display: block;">
            <input type="file" class="form-control" id="banner" name="banner"
                accept="image/jpg, image/png, image/jpeg" onchange="previewImage()" required>
        </div>

        <button type="submit" class="btn btn-primary">Edit Event</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function previewImage() {
            const image = $("#banner")[0];
            const imgPreview = $(".img-preview");

            imgPreview.css("display", "block");

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);
            ofReader.onload = function(oFREvent) {
                imgPreview.attr("src", oFREvent.target.result);
            }
        }

    </script>
@endsection
