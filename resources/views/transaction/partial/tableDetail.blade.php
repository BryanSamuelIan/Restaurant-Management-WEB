@foreach ($transaction_menus as $transaction_menu)


    <tr>
        <td class="text-center">{{ $transaction_menu->menu->name}}</td>
        <td class="text-center">{{ $transaction_menu->amount }}</td>
        <td class="text-center">{{ $transaction_menu->price }}</td>
        <td class="text-center">{{ $transaction_menu->price * $transaction_menu->amount }}</td>



    </tr>



@endforeach
