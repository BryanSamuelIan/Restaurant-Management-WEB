<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $suppliers = Supplier::all();

        return view('menu.index', [
            'menus' => $menus, 'category' => "alcohol",
            'pagetitle' => "Alkohol",
            'suppliers' => $suppliers,
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $parentMenus = Menu::where('category_id', 10)->get();

        return view('menu.create', [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'parentMenus' => $parentMenus,
            'pagetitle' => "Buat Menu"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('menu_photos', 'public');
        }

        // Create a new menu using create method
        $menuData = [
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'photo' => $photoPath,
            'is_alcohol' => 0,
            'is_combo' => ($request->input('category_id') == 11 || $request->input('category_id') == 12) ? 1 : 0,


            // Add more common fields as needed
        ];

        // Handle specific fields for alcohol categories (10, 11, 12)
        if (in_array($menuData['category_id'], [10, 11, 12])) {
            $menuData['supplier_id'] = $request->input('supplier_id');
            $menuData['alcohol%'] = $request->input('alcohol_percentage');
            $menuData['is_alcohol'] = 1;
            $menuData['parent_id'] = $request->input('parent_id'); // Include parent_id from form
            $menuData['combo_quantity'] = $request->input('combo_quantity'); // Include combo_quantity from form
        }

        // Create a new menu using create method
        $menu = Menu::create($menuData);


        return redirect()->route('owner.foods')->with('success', 'Menu created successfully');
    }


    public function update(Request $request, $id)
    {
        // Find the menu item to update
        $menu = Menu::findOrFail($id);

        // Update menu information
        $menu->name = $request->input('name');
        $menu->description = $request->input('description');
        $menu->price = $request->input('price');


        // Check if a new photo is provided
        if ($request->hasFile('photo')) {
            // Delete the old photo, if exists
            if ($menu->photo) {
                Storage::disk('public')->delete($menu->photo);
            }

            // Store the new photo
            $menu->photo = $request->file('photo')->store('menu_photos', 'public');
        }

        // Update the category and supplier information for alcohol categories
        if (in_array($request->input('category_id'), [10, 11, 12])) {
            $menu->supplier_id = $request->input('supplier_id');
            $menu['alcohol%'] = $request->input('alcohol_percentage');
            $menu->stock = $request->input('stock');
            $menu['parent_id'] = $request->input('parent_id'); // Include parent_id from form
            $menu['combo_quantity'] = $request->input('combo_quantity'); // Include combo_quantity from form
            $menu['is_alcohol']=1;
        } else {
            // Clear alcohol-related fields if the category is not alcohol
            $menu->supplier_id = null;
            $menu['alcohol%'] = null;
            $menu->stock = null;
            $menu['parent_id'] = null;
            $menu['combo_quantity'] = null;
            $menu['is_alcohol']=0;
        }
        $menu['is_combo'] = ($request->input('category_id') == 11 || $request->input('category_id') == 12) ? 1 : 0;

        // Save the changes
        $menu->save();

        return redirect()->route('owner.foods')->with('success', 'Menu updated successfully');
    }


    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $pagetitle = "Edit Menu";
        $suppliers = Supplier::all();
        $categories = Category::all();
        $parentMenus = Menu::where('category_id', 10)->get();

        // You may need to fetch additional data if required for the edit view
        return view('menu.edit', compact('menu', 'pagetitle', 'suppliers','categories','parentMenus'));
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // You may want to delete related records or perform additional actions

        // Delete the menu
        $menu->delete();

        return redirect()->route('owner.foods')->with('success', 'Menu deleted successfully');
    }
}
