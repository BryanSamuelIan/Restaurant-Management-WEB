@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Edit Menu</h2>
        @if (Auth::user()->isAdmin())
            <form id="createMenuForm"action="{{ route('admin.menu.update', $menu['id']) }}" method="post"
                enctype="multipart/form-data">
            @elseif(Auth::user()->isOwner())
                <form id="createMenuForm"action="{{ route('owner.menu.update', $menu['id']) }}" method="post"
                    enctype="multipart/form-data">
        @endif
        @method('put')
        @csrf


        <div class="mb-3">
            <label for="name" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Menu</label>
            <textarea class="form-control" id="description" name="description">{{ $menu->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga Menu</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $menu->price }}" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori </label>
            <select class="form-select" name="category_id" id="category_id">
                <option value="">Pilih Category</option>

                @foreach ($categories as $category)
                    @if (old('category_id', $menu->category_id) === $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Foto produk</label>




            @if ($menu->photo)
                <br>
                <img src="{{ asset('storage/' . $menu->photo) }}" alt="{{ $menu->name }}"
                    class="img-preview img-fluid mb-3 col-sm-5" style="display: block;">
            @else
                <img class="img-preview img-fluid mb-3 col-sm-5 mx-auto">
            @endif

            <input type="file" class="form-control" id="photo" name="photo"
                accept="image/jpg, image/png, image/jpeg" onchange="previewImage(this)">
        </div>
        <div id="alkohol-fields"
            style="{{ $menu->category && $menu->category->is_alcohol ? 'display: block;' : 'display: none;' }}">
            <div class="mb-3">
                <label for="supplier_id" class="form-label">Supplier (Khusus Kategori Alkohol)</label>
                <select class="form-select" name="supplier_id" id="supplier_id">
                    <option value="">Pilih Supplier</option> <!-- Default option with no value -->

                    @foreach ($suppliers as $supplier)
                        @if (old('supplier_id', $menu->supplier_id) === $supplier->id)
                            <option value="{{ $supplier->id }}" selected>{{ $supplier->name }}</option>
                        @else
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="alcohol_percentage" class="form-label">Persen Alkohol (Khusus Kategori Alkohol)</label>
                <input type="number" class="form-control" id="alcohol_percentage" name="alcohol_percentage" step="0.01"
                    value="{{ $menu['alcohol%'] }}" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Jumlah (Khusus Kategori Alkohol)</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ $menu->stock }}"
                    required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Menu</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function previewImage() {
            const image = $("#photo")[0];
            const imgPreview = $(".img-preview");

            imgPreview.css("display", "block");

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);
            ofReader.onload = function(oFREvent) {
                imgPreview.attr("src", oFREvent.target.result);
            }
        }



        document.addEventListener('DOMContentLoaded', function() {
            var alkoholFields = document.getElementById('alkohol-fields');

            function updateAlkoholFieldsDisplay() {
                var selectedCategoryId = parseInt(document.getElementById('category_id').value);
                var isAlcoholCategory = [10, 11, 12].includes(selectedCategoryId);

                alkoholFields.style.display = isAlcoholCategory ? 'block' : 'none';
            }

            // Initial update on page load
            updateAlkoholFieldsDisplay();

            // Add event listener to update display on category change
            document.getElementById('category_id').addEventListener('change', function() {
                updateAlkoholFieldsDisplay();
            });
        });
    </script>
@endsection
