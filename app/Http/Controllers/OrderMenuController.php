<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Category;
use App\Models\Payment_type;
use App\Models\Transaction_menu;
use Illuminate\Http\Request;

class OrderMenuController extends Controller
{


    public function index()
    {
        $menus = Menu::all();
        $categories = Category::all();
        return view('ordermenu', [
            "pagetitle" => "Order Menu",
            "maintitle" => "Menu",
            "menus" => $menus,
            "categories" => $categories
        ]);
    }
    public function store(Request $request)
    {
        $cartItems = json_decode($request->input('cartItems'), true);

        $tableNumber = $request->input('tableNumber');

        // Validate and store the transaction
        $transaction = new Transaction([
            'payment_type_id' => 1,
            'status_id' => 1,
            'table_no' => $tableNumber ?? 0,
            'user_id' => null,
            'transaction_time' => now(),
        ]);

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['quantity'] * $item['menuPrice'];


            // $menu = Menu::findOrFail($item['menuId']);

            // if ($menu->stock >= $item['quantity']) {
            //     $menu->stock -= $item['quantity'];
            //     $menu->save();

            //     // Add menu ID and decreased quantity to the array
            // }
            // if ($menu->is_combo == 1) {
            //     $parent = Menu::findOrFail($menu->parent_id);
            //     $parent->stock -= ($menu->combo_quantity * $item['quantity']);
            //     $parent->save();
            // }
        }

        // Assuming no additional charges for now
        $total = $subtotal;

        $transaction->subtotal = $subtotal;
        $transaction->total = $total;


        $transaction->save();

        // Attach menu items to the transaction
        foreach ($cartItems as $item) {
            if ($item['quantity'] > 0) {
                $transactionMenu = new Transaction_menu([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $item['menuId'],
                    'amount' => $item['quantity'],
                    'price' => $item['menuPrice']
                ]);

                $transactionMenu->save();
            }
        }

        // Redirect or respond as needed
        return redirect()->back()->with('transactionId', $transaction->id);
    }




}
