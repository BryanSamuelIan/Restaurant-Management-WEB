@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Pembelian</div>

                    <div class="card-body">

                        @if (Auth::user()->isAdmin())
                            <form action="{{ route('admin.purchase.update', ['id' => $purchase->id]) }}" method="post">
                            @elseif (Auth::user()->isOwner())
                                <form action="{{ route('owner.purchase.update', ['id' => $purchase->id]) }}" method="post">
                        @endif

                        @csrf


                        <div class="form-group">
                            <label for="name">Nama:</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ $purchase->name }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi:</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $purchase->description }}</textarea>
                        </div>

                        {{-- Set user_id based on the currently authenticated user --}}
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <div class="form-group">
                            <label for="transaction_time">Waktu Transaksi:</label>
                            <input type="date" class="form-control" id="transaction_time" name="transaction_time"
                                required value="{{ $purchase->transaction_time }}">
                        </div>

                        <div class="form-group">
                            <label for="payment">Payment:</label>
                            <input type="text" class="form-control" id="payment" name="payment" required
                                value="{{ $purchase->payment }}">
                        </div>

                        {{-- Display existing menus with their quantities and prices for editing --}}
                        <div id="menu-container">
                            @if ($purchase->menus)
                                @foreach ($purchase->menus as $menu)
                                    <div class="menu-item form-row align-items-center mb-2">
                                        <div class="col-md-6">
                                            <select class="form-control" name="menus[]" required>
                                                @foreach ($menus as $menuOption)
                                                    <option value="{{ $menuOption->id }}"
                                                        @if ($menu->id === $menuOption->id) selected @endif>
                                                        {{ $menuOption->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" name="quantities[]"
                                                placeholder="Quantity" value="{{ $menu->pivot->quantity ?? '' }}" required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" name="prices[]" placeholder="Price"
                                                value="{{ $menu->pivot->price ?? '' }}" required>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <button type="button" class="btn btn-success" onclick="addMenu()">Add Menu</button>

                        <button type="submit" class="btn btn-primary mt-3">Edit Pembelian</button>
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
    </script>
@endsection
