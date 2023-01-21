<?php

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
    return redirect('/admin/login');
    // return view('welcome');
});

Route::get('/pay_invoice', function () {
    if($_GET['total']>0){
    return view('payment');
    }
    else{
        return view('payerror');
    }
})->name('pay_invoice');
Route::get('/paysuccess', function () {
    return view('paysuccess');
})->name('paysuccess');
Route::get('/payerror', function () {
    return view('payerror');
})->name('payerror');