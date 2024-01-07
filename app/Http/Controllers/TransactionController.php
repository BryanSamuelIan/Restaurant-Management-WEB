<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Payment_type;
use App\Models\Transaction_menu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();
        return view('transaction.index', [
            'transactions' => $transactions,
            'pagetitle' => "Transaksi"
        ]);
    }

    public function indexToday()
    {
        $transactions = Transaction::whereDate('transaction_time', Carbon::today())->get();
        return view('transaction.index', [
            'transactions' => $transactions,
            'pagetitle' => "Transaksi Hari Ini"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $paymentTypes = Payment_type::all();

        return view('transaction.create', [
            'categories' => $categories, 'paymentTypes' => $paymentTypes,
            'pagetitle' => "Buat Transaksi"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $cartItems = json_decode($request->input('cartItems'), true);
    $tableNumber = $request->input('tableNumber');

    // Validate and store the transaction
    $transaction = new Transaction([
        'user_id' => auth()->user()->id,
        'transaction_time' => now(),
        'payment_type_id' => $request->input('paymentTypeId'),
        'status_id' => 2,
        'table_no' => $tableNumber ?? 0,
    ]);

    $subtotal = 0;

    // Initialize an array to keep track of decreased stock
    $decreasedStock = [];

    foreach ($cartItems as $item) {
        $subtotal += $item['quantity'] * $item['menuPrice'];

        // Decrease the stock of associated menu items
        $menu = Menu::findOrFail($item['menuId']);

        if ($menu->stock >= $item['quantity']) {
            $menu->stock -= $item['quantity'];
            $menu->save();



        }
        if ($menu->is_combo == 1) {
            $parent = Menu::findOrFail($menu->parent_id);
            $parent->stock -= ($menu->combo_quantity * $item['quantity']);
            $parent->save();
        }
    }

    // Assuming no additional charges for now
    $total = $subtotal;

    $transaction->subtotal = $subtotal;
    $transaction->total = $total;

    $transaction->save();

    // Attach menu items to the transaction
    foreach ($cartItems as $item) {
        $transactionMenu = new Transaction_menu([
            'transaction_id' => $transaction->id,
            'menu_id' => $item['menuId'],
            'amount' => $item['quantity'],
            'price' => $item['menuPrice']
        ]);

        $transactionMenu->save();
    }

    // Redirect or respond as needed
    return redirect()->route('transactions.today');
}



    public function getTransactionData()
    {
        $transactions = Transaction::all();

        return view('transaction.partial.table', compact('transactions'));
    }
    public function getTransactionDataDetail($id)
{
    $transactionMenus = Transaction_menu::where('transaction_id', $id)->get();
    // Use 'where' method with correct syntax: where('column_name', 'operator', 'value')

    return view('transaction.partial.tableDetail', compact('transactionMenus'));
    // Pass the retrieved data to the view
}

    public function getTransactionDataToday()
    {
        $transactions = Transaction::whereDate('transaction_time', Carbon::today())->get();

        return view('transaction.partial.table', compact('transactions'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transaction = Transaction::find($id);
        $categories = Category::all();
        $paymentTypes = Payment_type::all();
        $transactionMenus = Transaction_menu::where('transaction_id', $id)->get();

        // Assuming you have a method to format menus data in the desired format
        $initialCartItems = $this->formatMenus($transactionMenus);

        // dd($initialCartItems);

        return view('transaction.edit', [
            'transaction' => $transaction,
            'paymentTypes' => $paymentTypes,
            'categories' => $categories,
            'initialCartItems' => $initialCartItems,
            'id' => $id,
            'pagetitle' => "Edit Transaksi"
        ]);
    }
    public function detail($id)
    {
        $transaction = Transaction::find($id);
        $paymentTypeName = $transaction->payment_type->name;
        $transactionMenus = Transaction_menu::where('transaction_id', $id)->get();

        // Assuming you have a method to format menus data in the desired format


        // dd($initialCartItems);

        return view('transaction.detail', [
            'transaction' => $transaction,
            'paymentTypeName' => $paymentTypeName,
            'transaction_menus' => $transactionMenus,
            'id' => $id,
            'pagetitle' => "Detail Transaksi"
        ]);
    }


    // Add a method to format menus data
    protected function formatMenus($transactionMenus)
    {
        $formattedMenus = [];

        foreach ($transactionMenus as $transactionMenu) {
            $menu = $transactionMenu->menu;

            $formattedMenus[] = [
                'menuId' => $transactionMenu->menu_id,
                'menuName' => optional($menu)->name,
                'menuPrice' => optional($menu)->price,
                'quantity' => $transactionMenu->amount,
            ];
        }

        return $formattedMenus;
    }

    public function update(Request $request, $id)
    {

        // Find the existing transaction
        $transaction = Transaction::find($id);

        $tableNumber = $request->input('tableNumber');

        // Update the transaction details
        $transaction->update([
            'user_id' => auth()->user()->id, // Update user ID if needed
            'transaction_time' => now(), // Update transaction time if needed
            'payment_type_id' => $request->input('paymentTypeId')
        ]);

        $cartItems = json_decode($request->input('cartItems'), true);

        $this->updateOrCreateTransactionMenus($cartItems, $id);

        $subtotal = 0;
        foreach ($cartItems as $cartItem) {
            $subtotal += $cartItem['quantity'] * $cartItem['menuPrice'];
        }

        // Assuming no additional charges for now
        $total = $subtotal;

        // Update the transaction with the recalculated values
        $transaction->update([
            'subtotal' => $subtotal,
            'total' => $total,
            'table_no' => $tableNumber ?? 0,
        ]);

        return redirect()->route('transactions.today')->with('success', 'Transaction updated successfully');
    }

    public function updateStatus($id)
    {
        $transaction = Transaction::find($id);
        switch ($transaction->status_id) {
            case 1:
                $transaction->status_id = 2;
                break;
            case 2:
                $transaction->status_id = 6;
                break;
            case 6:
                $transaction->status_id = 1;
                break;
            default:
                // Handle other cases if needed
                break;
        }
        $transaction->save();
        // Store the current status for comparison
        $currentStatus = $transaction->status_id;
        switch ($currentStatus) {
            case 2:

                    $this->decreaseStock($id);

                break;
            case 6:

                    $this->increaseStock($id);


                break;
            default:
                // Handle other status changes if needed
                break;
        }


        return response()->json(['status' => $transaction->status]);

        // ... (remaining code)
    }

    protected function decreaseStock($transactionId)
    {
        $transactionMenus = Transaction_menu::where('transaction_id', $transactionId)->get();

        foreach ($transactionMenus as $transactionMenu) {
            $menu = Menu::findOrFail($transactionMenu->menu_id);

            if ($menu->stock >= $transactionMenu->amount) {
                $menu->stock -= $transactionMenu->amount;
                $menu->save();
            }
            if ($menu->is_combo == 1) {
                $parent = Menu::findOrFail($menu->parent_id);
                $parent->stock -= ($menu->combo_quantity * $transactionMenu['amount']);
                $parent->save();
            }
        }
    }

    protected function increaseStock($transactionId)
    {
        $transactionMenus = Transaction_menu::where('transaction_id', $transactionId)->get();

        foreach ($transactionMenus as $transactionMenu) {
            $menu = Menu::findOrFail($transactionMenu->menu_id);

            // Increase stock by the amount of items originally sold
            $menu->stock += $transactionMenu->amount;
            $menu->save();


            if ($menu->is_combo == 1) {
                $parent = Menu::findOrFail($menu->parent_id);
                $parent->stock += ($menu->combo_quantity * $transactionMenu['amount']);
                $parent->save();
            }
        }
    }




    protected function updateOrCreateTransactionMenus($cartItems, $transactionId)
    {
        foreach ($cartItems as $cartItem) {
            Transaction_menu::updateOrCreate(
                [
                    'transaction_id' => $transactionId,
                    'menu_id' => $cartItem['menuId'],
                ],
                [
                    'amount' => $cartItem['quantity'],
                    'price' => $cartItem['menuPrice'], // Update the price if needed
                    // Add other fields as needed
                ]
            );
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
