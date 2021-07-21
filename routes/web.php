<?php

use App\StockOpname;
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
Route::get('/ponumber','GoodReceiveController@po_number');
Route::get('/grdetail/{id_po}', 'GoodReceiveController@detail')->name('grdetail');

Route::resource('customer', 'CustomerController');

Route::resource('satuan','SatuanController');

Route::resource('category', 'CategoryController');

Route::resource('checker', 'CheckerController');

Route::resource('personinc', 'PersonInCController');

Route::resource('locat', 'LocationController');

Route::resource('purchaseorder', 'PurchaseOrderController');
Route::get('/detail-po/{nomor_po}','PurchaseOrderController@detail')->name('po-detail');

Route::resource('buyer', 'BuyerController');

Route::resource('goodissue', 'GoodIssueController');
Route::get('/gidetail/{id_gi}', 'GoodIssueController@detail')->name('gidetail');

Route::resource('stockopname', 'StockOpnameController');