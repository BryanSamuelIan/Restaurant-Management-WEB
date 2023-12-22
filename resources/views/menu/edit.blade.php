@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Edit Menu</h2>

    <form action="{{ route('menu.update', $menu->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
            <label for="photo" class="form-label">Foto produk</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
        </div>

        <div id="alkohol-fields" style="{{ $menu->category && $menu->category->is_alcohol ? 'display: block;' : 'display: none;' }}">
            <div class="mb-3">
                <label for="supplier_id" class="form-label">Supplier (Khusus Kategori Alkohol)</label>
                <select class="form-select" name="supplier_id" id="supplier_id">
                    <option value="">Pilih Supplier</option> <!-- Default option with no value -->
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $menu->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="alcohol_percentage" class="form-label">Persen Alkohol (Khusus Kategori Alkohol)</label>
                <input type="number" class="form-control" id="alcohol_percentage" name="alcohol_percentage" step="0.01" value="{{ $menu->alcohol_percentage }}">
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Jumlah (Khusus Kategori Alkohol)</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ $menu->stock }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Menu</button>
    </form>
</div>

<script>
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
