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

Route::get('/', 'IndexController@indexView');

Route::get('/detail/{UserID}/{id}', 'PizzaController@pizzaDetail');

Route::get('/add', 'PizzaController@addView');

Route::get('/delete/{id}', 'PizzaController@deleteView');

Route::get('/update/{id}', 'PizzaController@pizzaUpdateView');

Route::get('/history', 'TransactionController@viewTransaction');

Route::get('/history/detail', function () {
    return view('master/Transaction/Detail');
});

Route::get('/Register', function () {
    return view('master/Register');
});

Route::get('/ViewAllUser','UserController@GetListUserDetail');
Route::get('/ViewChart/{UserID}','TransactionController@GetChartList');
Route::post('/UpdateChartQty/{UserID}/{CartID}','TransactionController@UpdateQty');
Route::get('/DeleteCart/{UserID}/{CartID}','TransactionController@DeleteCart');
Route::post('/AddCart/{UserID}','TransactionController@AddCart');
Route::get('/CheckOutPizza/{UserID}','TransactionController@SaveTransactionCheckOut');
// Route::get('/ViewTransactionHistory/{UserID}','TransactionController@GetTransactionHistory');
// Route::get('/ViewTransactionHistoryDetail/{HTransactionID}','TransactionController@GetTransactionHistoryDetail');
Route::post('/SubmitRegistration','UserController@Register');



Route::post('/addPizza', 'PizzaController@addPizza');


Route::post('/update/pizza/{id}', 'PizzaController@pizzaUpdate');

Route::post('/delete/pizza/{id}', 'PizzaController@delete');

Route::get('/search', 'IndexController@indexSearch');
