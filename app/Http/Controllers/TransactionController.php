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
        return view('transaction.edit', ['transaction' => $transaction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
