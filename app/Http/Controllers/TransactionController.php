<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Category;
use App\Models\Payment_type;
use App\Models\Transaction_menu;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();
        return view('transaction.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $paymentTypes = Payment_type::all();

        return view('transaction.create', ['categories' => $categories, 'paymentTypes' => $paymentTypes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cartItems = json_decode($request->input('cartItems'), true);

        // Validate and store the transaction
        $transaction = new Transaction([
            'user_id' => auth()->user()->id, // Assuming you have authentication and a user is logged in
            'transaction_time' => now(), // You might want to adjust this based on your requirements
            'payment_type_id' => $request->input('paymentTypeId'),
            'status_id' => 2,
            'table_no'=>0,
        ]);

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['quantity'] * $item['menuPrice'];
        }

        // Assuming no additional charges for now
        $total = $subtotal;

        $transaction->subtotal = $subtotal;
        $transaction->total = $total;

        $transaction->save();

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
        return redirect()->route('analytics');
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
            'id' => $id
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

        // Update the transaction details
        $transaction->update([
            'user_id' => auth()->user()->id, // Update user ID if needed
            'transaction_time' => now(), // Update transaction time if needed
            'payment_type_id' => $request->input('paymentTypeId'),
            'status_id' => 2,
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
        ]);

        return redirect()->route('transactions')->with('success', 'Transaction updated successfully');
    }

    // Existing methods...

    // Add this method to update or create transaction_menus
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
