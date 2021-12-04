<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SellBillController;
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
Route::view('/reports', 'reports');
Route::view('/launcher', 'launcher')->name('launcher');
Route::view('/bill/sell', 'bill.sell')->name('sell.bill');


Route::get('/bill/sell/dismiss/{customer_bill_id}', [\App\Http\Controllers\SellBillController::class, 'dismiss_sell_bill'])
    ->name('bill.sell.dismiss');


Route::get('/bill/sell/pay-part/{sell_bill_id}', [\App\Http\Controllers\SellBillController::class, 'sell_bill_pay_part'])->name('bill.sell.pay.part');
Route::put('/bill/sell/pay-part/{sell_bill_id}', [\App\Http\Controllers\SellBillController::class, 'sell_bill_pay_part_update'])->name('bill.sell.pay.part.update');


Route::view('/bill/buy', 'bill.buy')->name('buy.bill');


Route::put('items/update-prices', [ItemController::class, 'update_prices'])->name('items.update.prices');
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
