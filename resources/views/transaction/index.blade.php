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
                            <th class="text-center">No.Meja</th>
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
        var initialRowCount;

        function fetchTransactionsData() {
            var url;
            if (currentRoute === '/transactions') {
                url = '/transactions/data';
            } else if (currentRoute === '/transactions/today') {
                url = '/transactions/data/today';
            }
            console.log(currentRoute);
            console.log(url);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(response) {
                    initialRowCount = $('#transactionsTable tbody tr').length;
                    console.log($('#transactionsTable tbody tr').length);
                    $('#transactionsTable tbody').empty().append(response);
                    console.log($('#transactionsTable tbody tr').length);
                    checkForNewData(initialRowCount);
                },
                error: function(error) {
                    console.error(error);
                },
            });
        }

        function checkForNewData(length) {
            var newDataArrived = $('#transactionsTable tbody tr').length > length;

            if (newDataArrived) {
                console.log("berhasil");
                showNotification("Notifikasi: Transaksi Baru", "Ada data transaksi baru yang ditambahkan!");
            }
        }

        function showNotification(title, message) {
            // Set the path to your sound file
            var soundFile = '{{ asset('sound/699705__skyernaklea__notification-bell-and-water.wav') }}';

            var notification = toastr.success(message, title, {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 0, // Set timeOut to 0 to make it indefinite
                onShown: function() {
                    playNotificationSound(soundFile);
                },
            });

            // Add ARIA attributes for accessibility
            notification.attr('aria-live', 'polite');
            notification.attr('role', 'alert');
            notification.css('background-color', '#333');
            notification.attr('aria-live', 'assertive');
        }

        function playNotificationSound(soundFile) {
            var audio = new Audio(soundFile);

            // Add an event listener for the 'ended' event
            audio.addEventListener('ended', function() {
                console.log('Audio has ended.');
            });

            audio.play().then(function() {
                // Unmute after a short delay
                setTimeout(function() {
                    audio.muted = false;
                }, 100);
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
                        console.log(response);

                        const newStatus = response.status.status_state;
                        const button = $(
                            `tr[data-transaction-id="${transactionId}"] button.status-btn`);

                        button.removeClass('btn-danger btn-success btn-warning');

                        switch (response.status.id) {
                            case 1:
                                button.addClass('btn-warning');
                                break;
                            case 2:
                                button.addClass('btn-success');
                                break;
                            case 6:
                                button.addClass('btn-danger');
                                break;
                            default:
                                break;
                        }

                        button.html(newStatus);

                        // Check for new data after the update
                        checkForNewData(response);
                    },
                    error: function(error) {
                        console.error(error);
                    },
                });
            }
        });
    </script>
@endsection
