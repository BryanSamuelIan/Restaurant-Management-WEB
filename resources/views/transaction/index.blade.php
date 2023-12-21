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
                                <td>{{ $transaction->payment_type->name }}</td>
                                <td>
                                    <button class="btn btn-block @if ($transaction->status_id == 1) btn-danger @elseif($transaction->status_id == 2) btn-success @endif">
                                        {{ $transaction->status->status_state }}
                                    </button>
                                </td>
                                
                                <td>Rp{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('transaction.edit', ['id' => $transaction->id]) }}"
                                        class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
