@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Pembelian</div>

                    <div class="card-body">
                        <form action="{{ route('purchase.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nama:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi:</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            {{-- Set user_id based on the currently authenticated user --}}
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                            <div class="form-group">
                                <label for="transaction_time">Waktu Transaksi:</label>
                                <input type="date" class="form-control" id="transaction_time" name="transaction_time" required>
                            </div>

                            <div class="form-group">
                                <label for="payment">Payment:</label>
                                <input type="text" class="form-control" id="payment" name="payment" required>
                            </div>

                            {{-- Add multiple menus with quantity and price --}}
                            <div class="form-group" id="menu-container">
                                <label for="menus">Menu:</label>
                                <div class="menu-item">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <select class="form-control" name="menus[]" required>
                                                @foreach ($menus as $menu)
                                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" name="quantities[]" placeholder="Quantity" required>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" name="prices[]" placeholder="Price" required>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger mt-2" onclick="removeMenu(this)">Remove</button>
                                </div>
                            </div>

                            <button type="button" class="btn btn-success" onclick="addMenu()">Add Menu</button>

                            <button type="submit" class="btn btn-primary mt-3">Tambah Pembelian</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function addMenu() {
            var container = $('#menu-container');
            var newItem = container.find('.menu-item:first').clone(true);
            container.append(newItem);
        }

        function removeMenu(button) {
            var container = $('#menu-container');
            $(button).parent('.menu-item').remove();
        }
    </script>
@endsection
