@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Expense</div>

                    <div class="card-body">
                        @if (Auth::user()->isAdmin())
                            <form action="{{ route('admin.expense.update', ['id' => $expense->id]) }}" method="post">
                        @endif
                        @if (Auth::user()->isOwner())
                            <form action="{{ route('owner.expense.update', ['id' => $expense->id]) }}" method="post">
                        @endif
                        @csrf


                        <div class="form-group">
                            <label for="name">Nama:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $expense->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi:</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $expense->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="total">Total:</label>
                            <input type="number" class="form-control" id="total" name="total"
                                value="{{ $expense->total }}" required>
                        </div>

                        {{-- Set user_id based on the currently authenticated user --}}
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <div class="form-group">
                            <label for="transaction_time">Waktu Transaksi:</label>
                            <input type="date" class="form-control" id="transaction_time" name="transaction_time"
                                value="{{ old('transaction_time', $expense->transaction_time) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="payment">Payment:</label>
                            <input type="text" class="form-control" id="payment" name="payment"
                                value="{{ $expense->payment }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Expense</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
