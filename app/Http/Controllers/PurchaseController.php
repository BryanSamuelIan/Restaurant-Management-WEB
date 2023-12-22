<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Expense;
use App\Models\Menu;
use App\Models\Menu_purchased;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::all();
        $purchases = Purchase::all();
        $pagetitle = "List Pengeluaran";

        return view('purchase.index', compact('expenses', 'purchases', 'pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::where('category_id', 10)->get();

        return view('purchase.create', [
            'pagetitle' => "Tambah Alkohol",
            'menus' => $menus,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data as needed

        // Create a new purchase record
        $purchase = Purchase::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description,
            'transaction_time' => $request->transaction_time,
            'payment' => $request->payment,
            'total' => 0
        ]);
        $menus = Menu::find($request->menus);

        // Attach menus with quantities and prices to the purchase
        foreach ($request->menus as $index => $menuId) {

            // Create menu_purchased record
            Menu_purchased::create([
                'purchase_id' => $purchase->id,
                'menu_id' => $menuId,
                'quantity' => $request->quantities[$index],
                'price' => $request->prices[$index],
            ]);
        }

        $menuPurchasedRecords = Menu_purchased::where('purchase_id', $purchase->id)->get();

        // Calculate the total from the sum of quantities and prices
        $total = $menuPurchasedRecords->sum(function ($menuPurchased) {
            return $menuPurchased->quantity * $menuPurchased->price;
        });

        // Update the total in the purchase record
        $purchase->update(['total' => $total]);

        // Redirect or do any additional processing
        return redirect()->route('purchase.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
