@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Create New Menu</h2>

        @if (Auth::user()->isAdmin())
            <form action="{{ route('admin.menu.store') }}" method="post" enctype="multipart/form-data">
        @endif
        @if (Auth::user()->isOwner())
            <form action="{{ route('owner.menu.store') }}" method="post" enctype="multipart/form-data">
        @endif
        @csrf

                <div class="mb-3">
                    <label for="category_id" class="form-label">Jenis Menu</label>
                    <select class="form-select" name="category_id" id="category_id">
                        <option value="">Pilih Kategori</option> <!-- Default option with no value -->
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" data-alkohol="{{ $category->is_alcohol }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Menu</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga Menu</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Foto produk</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5" style="display: none;">
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*" onchange="previewImage(this)">
                </div>



                <div id="alkohol-fields" style="display: none;">
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier (Khusus Kategori Alkohol)</label>
                        <select class="form-select" name="supplier_id" id="supplier_id" required>
                            <option value="">Pilih Supplier</option> <!-- Default option with no value -->
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" data-alkohol="{{ $category->is_alcohol }}">
                                    {{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="alcohol_percentage" class="form-label">Persen Alkohol (Khusus Kategori
                            Alkohol)</label>
                        <input type="number" class="form-control" id="alcohol_percentage" name="alcohol_percentage"
                            step="0.01">
                    </div>



                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Combo dari</label>
                        <select class="form-select" id="parent_id" name="parent_id">
                            <option value="">Pilih menu parent</option> <!-- Default option with no value -->
                            @foreach ($parentMenus as $parentMenu)
                                <option value="{{ $parentMenu->id }}">{{ $parentMenu->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="combo_quantity" class="form-label">Combo Quantity</label>
                        <input type="number" class="form-control" id="combo_quantity" name="combo_quantity">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create Menu</button>
            </form>
</div>

<script>
    // JavaScript to toggle fields based on selected category
    document.getElementById('category_id').addEventListener('change', function() {
            var selectedCategoryId = parseInt(this.value);
            var isAlcoholCategory = [10, 11, 12].includes(selectedCategoryId);
            var alkoholFields = document.getElementById('alkohol-fields');

            if (isAlcoholCategory) {
                alkoholFields.style.display = 'block';
            } else {
                alkoholFields.style.display = 'none';
            }
        });


    function previewImage(input) {
            const imgPreview = $(".img-preview");
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgPreview.attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
                imgPreview.css('display', 'block');
            }
        }
</script>
@endsection
