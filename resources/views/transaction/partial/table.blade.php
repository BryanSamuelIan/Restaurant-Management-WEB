@foreach ($transactions as $transaction)
    <tr data-status-id="{{ $transaction->status_id }}" data-payment-type-id="{{ $transaction->payment_type_id }}"
        data-transaction-id="{{ $transaction->id }}">
        <td class="text-center">{{ $transaction->id }}</td>
        <td class="text-center">{{ $transaction->transaction_time }}</td>
        <td class="text-center">{{ $transaction->payment_type->name }}</td>
        <td class="text-center">{{ $transaction->table_no }}</td>
        <td class="text-center">
            <button type="button"
                class="btn btn-block status-btn @if ($transaction->status_id == 1) btn-warning
                                        @elseif($transaction->status_id == 2) btn-success
                                        @elseif($transaction->status_id == 6) btn-danger @endif">
                {{ $transaction->status->status_state }}
            </button>
        </td>
        <td>Rp{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
        <td>Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>
        <td>
            <a href="{{ route('transaction.edit', ['id' => $transaction->id]) }}" class="btn btn-primary">Edit</a>
        </td>
    </tr>
@endforeach
