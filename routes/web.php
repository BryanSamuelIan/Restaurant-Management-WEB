<?php
use App\Http\Controllers;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\OrderMenuController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Employee;
use App\Models\Purchase;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('about', function () {
    return view('about', [
        "pagetitle" => "About Us"
    ]);
})->name('about');

Route::get('/admin', function () {
    return redirect('/login');
});
Route::get('contact', function () {
    return view('contact', [
        "pagetitle" => "Contact Us"
    ]);
})->name('contact');

//guest
Route::get('/ordermenu', [MenuController::class, 'index'])->name('ordermenu');
Route::post('/storeorder',[OrderMenuController::class,'store'])->name('store_order');


Auth::routes();
//employee
Route::get('/transactionIn', [HomeController::class, 'index'])->name('transactionIN');

//admin
Route::get('/transactionOut', [HomeController::class, 'index'])->name('transactionOUT');
Route::get('/menuEdit', [MenuController::class, 'index'])->name('menuEdit');
Route::get('/event', [EventController::class, 'index'])->name('event');
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');

//owner
Route::get('/employeesUser', [SupplierController::class, 'index'])->name('employeesUser');
// Route::get('/analytics', function () {
//     return view('analitics', [
//         "pagetitle" => "analitics"
//     ]);
// })->name('analitics');


Route::get('admin/users', [UserController::class, 'index'])->name('users');
Route::get('admin/employees', [EmployeeController::class, 'index'])->name('employees');
Route::get('admin/menus', [MenuController::class, 'listMenu'])->name('menus');
Route::get('admin/suppliers', [SupplierController::class, 'index'])->name('suppliers');
Route::get('admin/events', [EventController::class, 'index'])->name('events');
Route::get('admin/purchases', [PurchaseController::class, 'index'])->name('purchases');

Route::get('admin/foods', [MenuController::class, 'listFood'])->name('foods');
Route::get('admin/beverages', [MenuController::class, 'listBeverage'])->name('beverages');
Route::get('admin/alcohols', [MenuController::class, 'listAlcohol'])->name('alcohols');

Route::get('admin/user/create', [UserController::class, 'create'])->name('user.create');
Route::get('admin/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::get('admin/menu/create', [MenuController::class, 'create'])->name('menu.create');
Route::get('admin/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::get('admin/event/create', [EventController::class, 'create'])->name('event.create');
Route::get('admin/expense/create', [ExpenseController::class, 'create'])->name('expense.create');
Route::get('admin/purchase/create', [PurchaseController::class, 'create'])->name('purchase.create');

Route::post('admin/user/store', [UserController::class, 'store'])->name('user.store');
Route::post('admin/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::post('admin/menu/store', [MenuController::class, 'store'])->name('menu.store');
Route::post('admin/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
Route::post('admin/event/store', [EventController::class, 'store'])->name('event.store');
Route::post('admin/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
Route::post('admin/expense/store', [ExpenseController::class, 'store'])->name('expenses.store');
Route::post('admin/purchase/store', [PurchaseController::class, 'store'])->name('purchase.store');

Route::get('/admin/analytics', [AnalyticsController::class, 'index'])->name('analytics');

Route::post('/contact', [ContactController::class, 'sendMessage'])->name('sendEmail');


Route::get('admin/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
Route::get('admin/transactions', [TransactionController::class, 'index'])->name('transactions');
Route::get('admin/todaystransactions', [TransactionController::class, 'indexToday'])->name('transaction');
Route::get('admin/analytics', [AnalyticsController::class, 'index'])->name('analytics');

Route::get('admin/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
Route::put('admin/transactions/{id}', [TransactionController::class, 'update'])->name('transaction.update');

Route::put('admin/transactions/{id}/update-status', [TransactionController::class, 'updateStatus'])->name('transaction.update-status');
// routes/web.php
Route::put('admin/users/{id}/update-active-status', [UserController::class, 'updateActiveStatus'] )->name('user.update-isactive');
Route::put('/admin/users/{id}/update-password', [UserController::class, 'updatePassword'])->name('admin.users.update-password');

