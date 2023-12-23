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
                        @include('transaction.partial.table')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        var currentRoute;

        function fetchTransactionsData() {
            var url;
            if (currentRoute === '/transactions') {
                url = '/transactions/data';
            } else if (currentRoute=== '/transactions/today') {
                url = '/transactions/data/today';
            }
            console.log(currentRoute);
            console.log(url);
            $.ajax({
                method: 'GET',
                url: url, // Use the new route
                success: function(response) {
                    console.log(response);
                    $('#transactionsTable tbody').empty().append(response);
                },
                error: function(error) {
                    console.error(error);
                },
            });
        }
        $(document).ready(function() {
            currentRoute = window.location.pathname;
            fetchTransactionsData();
            setInterval(fetchTransactionsData, 5000);
            $('#transactionsTable').on('click', '.status-btn', function() {
                const transactionId = $(this).closest('tr').data('transaction-id');
                updateStatus(transactionId);
            });

            function updateStatus(transactionId) {
                $.ajax({
                    method: 'PUT',
                    url: `/transactions/${transactionId}/update-status`,
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // Handle success, e.g., update the UI or show a success message
                        console.log(response);

                        const newStatus = response.status.status_state;
                        const button = $(
                            `tr[data-transaction-id="${transactionId}"] button.status-btn`);

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
