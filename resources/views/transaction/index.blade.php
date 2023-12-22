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
                                data-payment-type-id="{{ $transaction->payment_type_id }}"
                                data-transaction-id="{{ $transaction->id }}">
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->transaction_time }}</td>
                                <td>{{ $transaction->payment_type->name }}</td>
                                <td>
                                    <button type="button"
                                        class="btn btn-block status-btn @if ($transaction->status_id == 1) btn-danger @elseif($transaction->status_id == 2) btn-success @endif">
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#transactionsTable').on('click', '.status-btn', function() {
                const transactionId = $(this).closest('tr').data('transaction-id');
                updateStatus(transactionId);
            });

            function updateStatus(transactionId) {
                $.ajax({
                    method: 'PUT',
                    url: `/admin/transactions/${transactionId}/update-status`,
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // Handle success, e.g., update the UI or show a success message
                        console.log(response);

                        const newStatus = response.status.status_state;
                        const button = $(
                        `tr[data-transaction-id="${transactionId}"] button.status-btn`);
                        button.html(newStatus);
                        button.toggleClass('btn-danger btn-success');
                    },
                    error: function(error) {
                        // Handle error, e.g., show an error message
                        console.error(error);
                    },
                });
            }
        });
    </script>
@endsection
