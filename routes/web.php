<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SupplierController;
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
    return view('home', [
        "pagetitle" => "Home"
    ]);
})->name('home');

Route::get('about', function () {
    return view('about', [
        "pagetitle" => "About Us"
    ]);
})->name('about');

Auth::routes();
//guest
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/home', [HomeController::class, 'index'])->name('home');

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

