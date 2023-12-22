<?php

namespace App\Http\Controllers\Owner;

use App\Models\Category;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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


    public function listMenu()
    {
        $menus = Menu::all();
        return view('menu.index', [
            'menus' => $menus, 'category' => "all",
            'pagetitle' => "Menu"
        ]);
    }

    public function listFood()
    {
        $menus = Menu::whereIn('category_id', [1, 2, 3, 4])->get();;

        return view('menu.index', [
            'menus' => $menus, 'category' => "food",
            'pagetitle' => "Makanan"
        ]);
    }

    public function listBeverage()
    {
        $menus = Menu::whereIn('category_id', [5, 6, 7, 8, 9])->get();;

        return view('menu.index', [
            'menus' => $menus, 'category' => "beverage",
            'pagetitle' => "Minuman"
        ]);
    }

    public function listAlcohol()
    {
        $menus = Menu::whereIn('category_id', [10, 11, 12])->get();;

        return view('menu.index', [
            'menus' => $menus, 'category' => "alcohol",
            'pagetitle' => "Alkohol"
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('menu.create', ['categories' => $categories, 'suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
