<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('launcher');
});
Route::view('/launcher', 'launcher')->name('launcher');
Route::view('/bill/sell', 'bill.sell')->name('sell.bill');
Route::view('/bill/buy', 'bill.buy')->name('buy.bill');

Route::get('/items/move-to-show', function () {
    return view('item.move-to-show', [
        'items' => \App\Models\Item::all(),
    ]);
})->name('items.move.to.show');
Route::post('/items/move-to-show', [ItemController::class, 'moveToShow'])->name('items.move.to.show');


Route::resource('customers', CustomerController::class);
Route::resource('units', UnitController::class);
Route::resource('vendors', VendorController::class);
Route::resource('groups', GroupController::class);
Route::resource('items', ItemController::class);


Route::get('sell/bill/{sellBill}', [\App\Http\Controllers\SellBillController::class, 'destroy'])
->name('sell.bill.destroy');
Route::get('sell/bill/customer/{customer}/print', [\App\Http\Controllers\SellBillController::class, 'print'])
    ->name('sell.bill.customer.print');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
