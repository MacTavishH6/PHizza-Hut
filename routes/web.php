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
    return view('welcome');
});

Route::get('/ViewAllUser','UserController@GetListUserDetail');
Route::get('/ViewChart/{UserID}','TransactionController@GetChartList');
Route::post('/UpdateChartQty/{UserID}/{CartID}','TransactionController@UpdateQty');
Route::get('/DeleteCart/{UserID}/{CartID}','TransactionController@DeleteCart');
Route::get('/AddChart/{UserID}/{PizzaID}/{PizzaQty}','TransactionController@AddChart');
Route::get('/CheckOutPizza/{UserID}','TransactionController@SaveTransactionCheckOut');
