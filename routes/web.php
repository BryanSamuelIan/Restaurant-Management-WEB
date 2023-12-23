<?php

use App\Http\Controllers\Owner\AnalyticsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Owner\EmployeeController;
use App\Http\Controllers\Admin\EventController as AEventController;
use App\Http\Controllers\Owner\EventController;
use App\Http\Controllers\Admin\ExpenseController as AExpenseController;
use App\Http\Controllers\Owner\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MenuController as AMenuController;
use App\Http\Controllers\Owner\MenuController;
use App\Http\Controllers\Admin\MenuPurchasedController as AMenuPurchasedController;
use App\Http\Controllers\Owner\MenuPurchasedController;
use App\Http\Controllers\Admin\PurchaseController as APurchaseController;
use App\Http\Controllers\Owner\PurchaseController;
use App\Http\Controllers\OrderMenuController;
use App\Http\Controllers\Admin\SupplierController as ASupplierController;
use App\Http\Controllers\Owner\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Owner\UserController;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



//guest

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about', [
        "pagetitle" => "About Us"
    ]);
})->name('about');

Route::get('/admin', function () {
    return redirect('/login');
});


Route::get('/contact', function () {
    return view('contact', [
        "pagetitle" => "Contact Us"
    ]);
})->name('contact');

Route::post('/contact', [ContactController::class, 'sendMessage'])->name('sendEmail');
Route::get('/ordermenu', [OrderMenuController::class, 'index'])->name('ordermenu');
Route::post('/storeorder', [OrderMenuController::class, 'store'])->name('store_order');

// Route::get('/employeesUser', [SupplierController::class, 'index'])->name('employeesUser');
// Route::get('/transactionIn', [HomeController::class, 'index'])->name('transactionIN');






Auth::routes();
//employee

Route::post('/transaction/store', [TransactionController::class, 'store'])->middleware('auth')->name('transaction.store');
Route::get('/transaction/create', [TransactionController::class, 'create'])->middleware('auth')->name('transaction.create');
Route::get('/transactions', [TransactionController::class, 'index'])->middleware('auth')->name('transactions');
Route::get('/transactions/today', [TransactionController::class, 'indexToday'])->middleware('auth')->name('transactions.today');
Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])->middleware('auth')->name('transaction.edit');
Route::put('/transactions/{id}', [TransactionController::class, 'update'])->middleware('auth')->name('transaction.update');
Route::put('/transactions/{id}/update-status', [TransactionController::class, 'updateStatus'])->middleware('auth')->name('transaction.update-status');

Route::get('/transactions/data', [TransactionController::class, 'getTransactionData'])->middleware('auth')->name('transaction.data');
Route::get('/transactions/data/today', [TransactionController::class, 'getTransactionDataToday'])->middleware('auth')->name('transaction.data.today');


//admin
Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {

    Route::get('/menus/{id}/edit', [AMenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menus/{id}', [AMenuController::class, 'update'])->name('menu.update');
    Route::delete('/menus/{id}', [AMenuController::class, 'destroy'])->name('menu.destroy');
    Route::get('/menuEdit', [AMenuController::class, 'index'])->name('menuEdit');
    Route::get('/event', [AEventController::class, 'index'])->name('event');
    Route::get('/supplier', [ASupplierController::class, 'index'])->name('supplier.index');
    Route::get('/menus', [AMenuController::class, 'listMenu'])->name('menus');
    Route::get('/suppliers', [ASupplierController::class, 'index'])->name('suppliers');
    Route::get('/events', [AEventController::class, 'index'])->name('events');
    Route::get('/purchases', [APurchaseController::class, 'index'])->name('purchases');
    Route::get('/foods', [AMenuController::class, 'listFood'])->name('foods');
    Route::get('/beverages', [AMenuController::class, 'listBeverage'])->name('beverages');
    Route::get('/alcohols', [AMenuController::class, 'listAlcohol'])->name('alcohols');
    Route::get('/menu/create', [AMenuController::class, 'create'])->name('menu.create');
    Route::get('/supplier/create', [ASupplierController::class, 'create'])->name('supplier.create');
    Route::get('/event/create', [AEventController::class, 'create'])->name('event.create');
    Route::get('/expense/create', [AExpenseController::class, 'create'])->name('expense.create');
    Route::get('/purchase/create', [APurchaseController::class, 'create'])->name('purchase.create');
    Route::post('/menu/store', [AMenuController::class, 'store'])->name('menu.store');
    Route::post('/supplier/store', [ASupplierController::class, 'store'])->name('supplier.store');
    Route::post('/event/store', [AEventController::class, 'store'])->name('event.store');
    Route::post('/expense/store', [AExpenseController::class, 'store'])->name('expenses.store');
    Route::post('/purchase/store', [APurchaseController::class, 'store'])->name('purchase.store');
}
);


//owner

Route::group([
    'middleware' => 'owner',
    'prefix' => 'owner',
    'as' => 'owner.'
], function () {
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::put('/users/{id}/update-active-status', [UserController::class, 'updateActiveStatus'])->name('user.update-isactive');
    Route::put('/users/{id}/update-password', [UserController::class, 'updatePassword'])->name('admin.users.update-password');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    Route::get('/menus/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menus/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menus/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::get('/menuEdit', [MenuController::class, 'index'])->name('menuEdit');
    Route::get('/event', [EventController::class, 'index'])->name('event');
    Route::get('/supplier', [ASupplierController::class, 'index'])->name('supplier.index');
    Route::get('/menus', [MenuController::class, 'listMenu'])->name('menus');
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');
    Route::get('/events', [EventController::class, 'index'])->name('events');
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases');
    Route::get('/foods', [MenuController::class, 'listFood'])->name('foods');
    Route::get('/beverages', [MenuController::class, 'listBeverage'])->name('beverages');
    Route::get('/alcohols', [MenuController::class, 'listAlcohol'])->name('alcohols');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::get('/expense/create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::get('/purchase/create', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
    Route::post('/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
    Route::post('/expense/store', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::post('/purchase/store', [PurchaseController::class, 'store'])->name('purchase.store');

}
);





