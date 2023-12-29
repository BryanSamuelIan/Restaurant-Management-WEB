@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-center" >
            <div class="row-1 d-flex align-items-center " >
                <svg onclick="history.back()" fill="#000000" width="24" height="24" viewBox="0 0 299.021 299.021" version="1.1" id="Capa_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 299.021 299.021" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <g>
                                <path
                                    d="M292.866,254.432c-2.288,0-4.443-1.285-5.5-3.399c-0.354-0.684-28.541-52.949-146.169-54.727v51.977 c0,2.342-1.333,4.48-3.432,5.513c-2.096,1.033-4.594,0.793-6.461-0.63L2.417,154.392C0.898,153.227,0,151.425,0,149.516 c0-1.919,0.898-3.72,2.417-4.888l128.893-98.77c1.87-1.426,4.365-1.667,6.461-0.639c2.099,1.026,3.432,3.173,3.432,5.509v54.776 c3.111-0.198,7.164-0.37,11.947-0.37c43.861,0,145.871,13.952,145.871,143.136c0,2.858-1.964,5.344-4.75,5.993 C293.802,254.384,293.34,254.432,292.866,254.432z">
                                </path>
                            </g>
                        </g>
                    </g>
                </svg>

            </div>
        </div>


        <div class="row">
            <!-- On large screens: Table occupies 2/3 width, Recap occupies 1/3 width -->
            <div class="col-lg-8 px-5 border-end mb-4 mb-lg-0"> <!-- Adjust column width for large screens -->
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Item</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('transaction.partial.tableDetail')
                    </tbody>
                </table>
            </div>

            <div class="col-lg-4"> <!-- Recap Column, occupies 1/3 width on large screens -->
                <div class="recap-section text-center">
                    <h3 class="text-center">Transaction Recap</h3>
                    <div>
                        <p><strong>Transaction ID:</strong> {{ $transaction->id }}</p>
                        <p><strong>Transaction Time:</strong> {{ $transaction->transaction_time }}</p>
                        <p><strong>Last Updated:</strong> {{ $transaction->updated_at }}</p>
                        <p><strong>Table Number:</strong> {{ $transaction->table_no }}</p>
                        <p><strong>Subtotal:</strong> Rp{{ number_format($transaction->subtotal, 0, ',', '.') }}</p>
                        <p><strong>Total:</strong> Rp{{ number_format($transaction->total, 0, ',', '.') }}</p>
                        <p><strong>Payment Type:</strong> {{ $transaction->payment_type->name }}</p>
                        <p><strong>Status:</strong> {{ $transaction->status->status_state }}</p>
                        @if (isset($transaction->adminname->name))
                        <p><strong>Taken By:</strong> {{ $transaction->adminname->name}}</p>
                        @else
                        <p><strong>Taken By:</strong> Not available</p>
                        @endif
                        <p>
                            <a href="{{ route('transaction.edit', ['id' => $transaction->id]) }}"
                                class="btn btn-primary">Edit</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- On small and medium screens: Table above Recap -->
            <div class="col-12 mt-4 d-lg-none"> <!-- Show only on small and medium screens -->
                <div class="table-for-small-screens">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Item</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('transaction.partial.tableDetail')
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 mt-4 d-lg-none"> <!-- Show only on small and medium screens -->
                <div class="recap-for-small-screens text-center">
                    <h3 class="text-center">Transaction Recap</h3>
                    <div>
                        <p><strong>Transaction ID:</strong> {{ $transaction->id }}</p>
                        <p><strong>Transaction Time:</strong> {{ $transaction->transaction_time }}</p>
                        <p><strong>Table Number:</strong> {{ $transaction->table_no }}</p>
                        <p><strong>Subtotal:</strong> Rp{{ number_format($transaction->subtotal, 0, ',', '.') }}</p>
                        <p><strong>Total:</strong> Rp{{ number_format($transaction->total, 0, ',', '.') }}</p>
                        <p><strong>Payment Type:</strong> {{ $transaction->payment_type->name }}</p>
                        <p><strong>Status:</strong> {{ $transaction->status->status_state }}</p>
                        @if (isset($transaction->adminname->name))
                        <p><strong>Taken By:</strong> {{ $transaction->adminname->name}}</p>
                        @else
                        <p><strong>Taken By:</strong> Not available</p>
                        @endif

                        <p>
                            <a href="{{ route('transaction.edit', ['id' => $transaction->id]) }}"
                                class="btn btn-primary">Edit</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
