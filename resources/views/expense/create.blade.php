@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Pengeluaran</div>

                    <div class="card-body">
                        <form action="{{ route('expenses.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nama:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi:</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="total">Total:</label>
                                <input type="number" class="form-control" id="total" name="total" required>
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

                            <button type="submit" class="btn btn-primary mt-3">Tambah Expense</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
