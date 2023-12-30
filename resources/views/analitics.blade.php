@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 ">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Transaksi Hari Ini</p>
                            <h4 class="mb-0"> {{ $transactionCount }} </h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        @if ($transactionsDifference > 0)
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Lebih
                                    {{ $transactionsDifference }} dari kemarin</span></p>
                        @elseif ($transactionsDifference < 0)
                            <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">Kurang
                                    {{ abs($transactionsDifference) }} dari kemarin</span></p>
                        @else
                            <p class="mb-0">Tidak ada perubahan dari kemarin</p>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Pemasukkan Hari Ini</p>
                            <h4 class="mb-0">Rp{{ number_format($incomeToday, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0">
                            <span
                                class="{{ $difference >= 0 ? 'text-success' : 'text-danger' }} text-sm font-weight-bolder">
                                {{ number_format($difference, 2) }}%
                            </span>
                            dari kemarin
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="position-relative">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl position-absolute top-0 start-0"
                                style="width: 70px; height: 70px;">
                                <img src="{{ asset('/images/money-bag.png') }}" alt="Your Image" class="img-fluid">
                            </div>
                        </div>

                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Pemasukkan Bulan Ini</p>
                            <h4 class="mb-0">Rp{{ number_format($income, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0">
                            <span
                                class="text-{{ $incomeDifference >= 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">
                                {{ $incomeDifference >= 0 ? '+' : '-' }}{{ abs($incomeDifference) }}%
                            </span>
                            dari bulan lalu
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 ">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Pengeluaran Bulan Ini</p>
                            <h4 class="mb-0"> Rp{{ number_format($purchase, 0, ',', '.') }} </h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0">Pengeluaran</p>
                    </div>

                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 p-5">
                        <div class="table-responsive">
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
                                                    class="btn btn-block status-btn @if ($transaction->status_id == 1) btn-warning
                                                @elseif($transaction->status_id == 2) btn-success
                                                @elseif($transaction->status_id == 6) btn-danger @endif">
                                                    {{ $transaction->status->status_state }}
                                                </button>
                                            </td>

                                            <td>Rp{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                                            <td>Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
