@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 px-5">
                <table id="transactionsTable" class="table">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Waktu Transaksi</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Subtotal</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr data-status-id="{{ $transaction->status_id }}"
                                data-payment-type-id="{{ $transaction->payment_type_id }}">
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->transaction_time }}</td>
                                <td class="payment-type-color-{{ $transaction->payment_type_id }}">{{ $transaction->payment_type->name }}</td>
                                <td class="status-color-{{ $transaction->status_id }}">{{ $transaction->status->status_state }}</td>                                
                                <td>Rp{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('transaction.edit', ['transactionId' => $transaction->id]) }}" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
