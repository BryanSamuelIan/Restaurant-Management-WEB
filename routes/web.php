<?php
use App\Http\Controllers;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');


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
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();
//employee
Route::get('/transactionIn', [HomeController::class, 'index'])->name('transactionIN');

//admin
Route::get('/transactionOut', [HomeController::class, 'index'])->name('transactionOUT');
Route::get('/menuEdit', [MenuController::class, 'index'])->name('menuEdit');
Route::get('/eventEdit', [EventController::class, 'index'])->name('eventEdit');
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');

//owner
Route::get('/employeesUser', [SupplierController::class, 'index'])->name('employeesUser');
Route::get('analitics', function () {
    return view('analitics', [
        "pagetitle" => "analitics"
    ]);
})->name('analitics');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('admin/users', [UserController::class, 'index'])->name('users');
Route::get('admin/employees', [EmployeeController::class, 'index'])->name('employees');
Route::get('admin/menus', [MenuController::class, 'index'])->name('menus');
Route::get('admin/suppliers', [SupplierController::class, 'index'])->name('suppliers');
Route::get('admin/events', [EventController::class, 'index'])->name('events');

Route::get('admin/foods', [MenuController::class, 'listFood'])->name('foods');
Route::get('admin/beverages', [MenuController::class, 'listBeverage'])->name('beverages');
Route::get('admin/alcohols', [MenuController::class, 'listAlcohol'])->name('alcohols');
