@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 px-5">
                <table id="transactionsTable" class="table">
                    <thead>
                        <tr>
                            <th class="text-center">ID Transaksi</th>
                            <th class="text-center">Waktu Transaksi</th>
                            <th class="text-center">Metode Pembayaran</th>
                            <th class="text-center">Status Pembayaran</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr data-status-id="{{ $transaction->status_id }}"
                                data-payment-type-id="{{ $transaction->payment_type_id }}"
                                data-transaction-id="{{ $transaction->id }}">
                                <td class="text-center">{{ $transaction->id }}</td>
                                <td class="text-center">{{ $transaction->transaction_time }}</td>
                                <td class="text-center">{{ $transaction->payment_type->name }}</td>
                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-block status-btn @if ($transaction->status_id == 1) btn-warning 
                                        @elseif($transaction->status_id == 2) btn-success 
                                        @elseif($transaction->status_id == 6) btn-danger @endif">
                                        {{ $transaction->status->status_state }}
                                    </button>
                                </td>

                                <td class="text-center">Rp{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                                <td class="text-center">Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>
                                <td class="text-center">
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
                        const button = $(`tr[data-transaction-id="${transactionId}"] button.status-btn`);
    
                        // Remove existing classes
                        button.removeClass('btn-danger btn-success btn-warning');
    
                        // Add the appropriate class based on the new status
                        switch (response.status.id) {
                            case 1:
                                button.addClass('btn-warning'); // Yellow or orange
                                break;
                            case 2:
                                button.addClass('btn-success'); // Green
                                break;
                            case 6:
                                button.addClass('btn-danger'); // Red
                                break;
                            default:
                                // Handle other cases if needed
                                break;
                        }
    
                        button.html(newStatus);
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
