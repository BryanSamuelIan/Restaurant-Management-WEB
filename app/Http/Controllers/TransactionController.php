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

            // Add menu ID and decreased quantity to the array
            $decreasedStock[$menu->id] = $item['quantity'];
        } else {
            // If there's insufficient stock for any item, revert the stock changes and return an error
            foreach ($decreasedStock as $menuId => $quantityDecreased) {
                $menu = Menu::findOrFail($menuId);
                $menu->stock += $quantityDecreased;
                $menu->save();
            }

            return redirect()->back()->with('error', 'Insufficient stock for some items!');
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

        // Store the current status for comparison
        $currentStatus = $transaction->status_id;

        // Update the status as required
        // ... (existing code)

        // Assuming status transition from 1 to 2 decreases stock and from 2 to 6 increases stock
        switch ($currentStatus) {
            case 1:
                // Check if the updated status is 2
                if ($transaction->status_id === 2) {
                    $this->decreaseStock($id);
                }
                break;
            case 2:
                // Check if the updated status is 6
                if ($transaction->status_id === 6) {
                    $this->increaseStock($id);
                }
                break;
            default:
                // Handle other status changes if needed
                break;
        }

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
            } else {
                // Handle insufficient stock scenario
                // You can either revert the status change or handle it based on your requirements
                return response()->json(['error' => 'Insufficient stock for some items!'], 400);
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
