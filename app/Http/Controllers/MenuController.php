<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        $categories=Category::all();
        return view('menu.index', [
            "pagetitle" => "Order Menu",
            "maintitle" => "Menu",
            "menus" => $menus,
            "categories"=>$categories
        ]);
    }

    public function listMenu() {
        $menus = Menu::all();
        return view('ordermenu', ['menus' => $menus, 'category' => "all"]);
    }

    public function listFood()
    {
        $menus = Menu::whereIn('category_id', [1, 2, 3, 4])->get();;

        return view('menu.index', ['menus' => $menus, 'category' => "food"]);
    }

    public function listBeverage()
    {
        $menus = Menu::whereIn('category_id', [5, 6, 7, 8, 9])->get();;

        return view('menu.index', ['menus' => $menus, 'category' => "beverage"]);
    }

    public function listAlcohol()
    {
        $menus = Menu::whereIn('category_id', [10, 11, 12])->get();;

        return view('menu.index', ['menus' => $menus, 'category' => "alcohol"]);
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
