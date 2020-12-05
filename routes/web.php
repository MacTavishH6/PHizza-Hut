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

Route::get('/detail/{id}', 'PizzaController@pizzaDetail');

Route::get('/add', 'PizzaController@addView');

Route::get('/delete/{id}', 'PizzaController@deleteView');

Route::get('/update/{id}', 'PizzaController@pizzaUpdateView');

Route::get('/history', 'TransactionController@viewTransaction');

Route::get('/history/detail', function () {
    return view('master/Transaction/Detail');
});

Route::get('/ViewAllUser','UserController@GetListUserDetail');
Route::get('/ViewChart/{UserID}','TransactionController@GetChartList');
Route::post('/UpdateChartQty/{UserID}/{CartID}','TransactionController@UpdateQty');
Route::get('/DeleteCart/{UserID}/{CartID}','TransactionController@DeleteCart');
Route::get('/AddChart/{UserID}/{PizzaID}/{PizzaQty}','TransactionController@AddChart');
Route::get('/CheckOutPizza/{UserID}','TransactionController@SaveTransactionCheckOut');
Route::post('/addPizza', 'PizzaController@addPizza');

Route::post('/update/pizza/{id}', 'PizzaController@pizzaUpdate');

Route::post('/delete/pizza/{id}', 'PizzaController@delete');

Route::get('/search', 'IndexController@indexSearch');
