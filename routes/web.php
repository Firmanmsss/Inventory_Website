<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::resource('partnamectr', 'PartNameController');

Route::resource('goodreceipt','GoodReceiveController');
Route::get('/detail-gr/{id}','DetailGoodReceiveController@index')->name('gr-detail');

Route::resource('customer', 'CustomerController');

Route::resource('satuan','SatuanController');

Route::resource('category', 'CategoryController');

Route::resource('checker', 'CheckerController');

Route::resource('personinc', 'PersonInCController');

Route::resource('locat', 'LocationController');

Route::resource('purchaseorder', 'PurchaseOrderController');
Route::get('/detail-po/{nomor_po}','PurchaseDetailController@index')->name('po-detail');

Route::resource('buyer', 'BuyerController');