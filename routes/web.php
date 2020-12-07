<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthMember;

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

//Home or Index view
Route::get('/', 'IndexController@indexView');

//Route for see pizza details
Route::get('/detail/{UserID}/{id}', 'PizzaController@pizzaDetail')->middleware('authmember');
Route::get('/detail/{id}', 'PizzaController@pizzaDetailGuest');
//---------------------------

//Route for CRUD Pizza view
Route::get('/add', 'PizzaController@addView')->middleware('authadmin');
Route::get('/delete/{id}', 'PizzaController@deleteView')->middleware('authadmin');
Route::get('/update/{id}', 'PizzaController@pizzaUpdateView')->middleware('authadmin');
//--------------------------

//Route for register and login view
Route::get('/register', function () {
    return view('Register');
});
Route::get('/login', function () {
    return view('/login');
});
//---------------------------------

//Route for View all user and view all user transaction
Route::get('/ViewAllUser','UserController@GetListUserDetail')->middleware('authadmin');
Route::get('/ViewAllUserTransaction','TransactionController@viewAllUserTransaction')->middleware('authadmin');
//-----------------------------------------------------

//Route for Cart CRUD
Route::get('/ViewChart/{UserID}','TransactionController@GetChartList')->middleware('authmember');
Route::post('/UpdateChartQty/{UserID}/{CartID}','TransactionController@UpdateQty')->middleware('authmember');
Route::get('/DeleteCart/{UserID}/{CartID}','TransactionController@DeleteCart')->middleware('authmember');
Route::post('/AddCart/{UserID}','TransactionController@AddCart')->middleware('authmember');
Route::get('/CheckOutPizza/{UserID}','TransactionController@SaveTransactionCheckOut')->middleware('authmember');
//-------------------

//Route for see transaction history and transaction history detail for member
Route::get('/history/{UserID}','TransactionController@viewTransaction')->middleware('authmember');
Route::get('/history/detail/{HTransactionID}','TransactionController@viewTransactionDetail')->middleware('authmember');
//---------------------------------------------------------------------------

//Route for submiting registration form
Route::post('/SubmitRegistration','UserController@Register');
//-------------------------------------

//Route for loging in
Route::post('/Auth','UserController@Login');
//-------------------

//Route for loging out
Route::get('/logout','UserController@LogOut');
//--------------------

//Route for pizza CRUD
Route::post('/addPizza', 'PizzaController@addPizza')->middleware('authadmin');
Route::post('/update/pizza/{id}', 'PizzaController@pizzaUpdate')->middleware('authadmin');
Route::post('/delete/pizza/{id}', 'PizzaController@delete')->middleware('authadmin');
//--------------------

//Route for searching pizza
Route::get('/search', 'IndexController@indexSearch');
//-------------------------

