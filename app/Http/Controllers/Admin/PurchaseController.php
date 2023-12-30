<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function edit(string $id)
{
    $menus = Menu::where('category_id', 10)->get();
    $purchaseEdit = Purchase::with(['menus' => function ($query) {
        $query->withPivot('quantity', 'price'); // Load pivot data
    }])->find($id);

    // Check if the purchase was found
    if ($purchaseEdit) {
        return view('purchase.edit', [
            'purchase' => $purchaseEdit,
            'pagetitle' => "Edit Purchase",
            'menus' => $menus
        ]);
    } else {
        // Handle the case where the purchase is not found
        return redirect()->route('error.page')->with('error', 'Purchase not found');
    }
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
        return redirect()->route('admin.purchases');
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
    public function edit(string $id)
    {
        $purchaseEdit = Purchase::find($id);
        return view('purchase.edit', ['purchase' => $purchaseEdit,
            'pagetitle' => "Edit Purchase"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validate the request data as needed

    // Find the purchase record to update
    $purchase = Purchase::findOrFail($id);

    // Update the purchase record
    $purchase->update([
        'user_id' => $request->user_id,
        'name' => $request->name,
        'description' => $request->description,
        'transaction_time' => $request->transaction_time,
        'payment' => $request->payment,
    ]);

    // Remove existing menu_purchased records for this purchase
    Menu_purchased::where('purchase_id', $purchase->id)->delete();

    // Attach updated menus with quantities and prices to the purchase
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
    return redirect()->route('admin.purchases');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Purchase::find($id)->delete();
        return redirect()->route('admin.purchases');

    }
}
