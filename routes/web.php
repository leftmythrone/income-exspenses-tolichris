<?php

use Illuminate\Support\Facades\Route;

// MODELS
// use App\Models\Account;
// use App\Models\Income;
// use App\Models\Expense;
// use App\Models\Debt;
// use App\Models\Login;

// CONTROLLLER
use App\Http\Controllers\UtilitiesController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\AccountController;


Route::get('/laravel', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| SOURCE OF UTILITIES
|--------------------------------------------------------------------------
|
| Here is where you can register web routes source of utilities for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// GETTING STARTED PAGE
Route::get('/', [UtilitiesController::class, 'login'])->name('login');

// AUTHENTICATE
Route::post('/login', [UtilitiesController::class, 'authenticate']);

// LOGOUT
Route::get('/logout', [UtilitiesController::class, 'logout']);

// ALL CHART PAGE
Route::get('/mychart', [UtilitiesController::class, 'chart'])->middleware('auth');

// PRINT CHART
Route::get('/mychart/print', [UtilitiesController::class, 'printstore'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| SOURCE OF USERS
|--------------------------------------------------------------------------
|
| Here is where you can register web routes source of utilities for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// OPEN
Route::get('/account', [AccountController::class, 'start'])->middleware('auth');

// ADD NEW
Route::get('/account/create', [AccountController::class, 'create'])->middleware('auth');
Route::post('/account/store', [AccountController::class, 'store'])->middleware('auth');

// FOR SUMMATION
Route::get('/account/sum/{account_slug}', [AccountController::class, 'sum'])->middleware('auth');
Route::post('/account/summation/{account_slug}', [AccountController::class, 'summation'])->middleware('auth');

// SUBSTRACTION
Route::get('/account/sub/{account_slug}', [AccountController::class, 'sub'])->middleware('auth');
Route::post('/account/subtraction/{account_slug}', [AccountController::class, 'subtraction'])->middleware('auth');

// FOR SEARCH EDIT ID
Route::get('/account/edit/{account_slug}', [AccountController::class, 'edit'])->middleware('auth');
Route::post('/account/update/{account_slug}', [AccountController::class, 'update'])->middleware('auth');

// FOR DESTROY
Route::get('/account/target/{account_slug}', [AccountController::class, 'find'])->middleware('auth');
Route::get('/account/delete/{account_slug}', [AccountController::class, 'delete'])->middleware('auth');

// REFRESH & SAVE DATABASE
Route::get('/account/decision/', [AccountController::class, 'ask'])->middleware('auth');
Route::get('/account/decision/fresh', [AccountController::class, 'clear'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| SOURCE OF USERS
|--------------------------------------------------------------------------
|
| Here is where you can register web routes source of utilities for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// OPEN
Route::get('/user', [UtilitiesController::class, 'user']);

// CREATE
Route::post('/user/userstore', [UtilitiesController::class, 'userstore']);

// UPDATE
Route::get('/user/editlanding/{user_slug}',[UtilitiesController::class, 'edituserlanding'])->middleware('auth');
Route::get('/user/useredit/{user_slug}',[UtilitiesController::class, 'edituser'])->middleware('auth');

// DELETE
Route::get('/user/userdelete/{user_slug}',[UtilitiesController::class, 'deleteuser'])->middleware('auth');

// CREATE
Route::get('/emergency', [UtilitiesController::class, 'emergency']);
Route::post('/emergency/404', [UtilitiesController::class, 'emergency404']);



/*
|--------------------------------------------------------------------------
| SOURCE OF INCOMES
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded ebby the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// OPEN
Route::get('/income', [IncomeController::class, 'start'])->middleware('auth');
Route::get('/income/entries/{entdata}', [IncomeController::class, 'entries'])->middleware('auth');

// VIEW 
Route::get('/income/viewlist/{incat_slug}',[IncomeController::class, 'viewlist'])->middleware('auth');
Route::get('/income/viewcategory/{income_slug}',[IncomeController::class, 'viewcategory'])->middleware('auth');

// CREATE
Route::post('/income/addnew',[IncomeController::class, 'addlist'])->middleware('auth');
Route::post('/income/addcategory',[IncomeController::class, 'addcategory'])->middleware('auth');

// UPDATE STORE
Route::get('/income/editlanding/{incat_slug}',[IncomeController::class, 'editcatlanding'])->middleware('auth');
Route::get('/income/editstore/{income_slug}',[IncomeController::class, 'editstore'])->middleware('auth');

// UPDATE
Route::post('/income/editcategory/{income_slug}',[IncomeController::class, 'editcategory'])->middleware('auth');
Route::post('/income/editlist/{income_slug}',[IncomeController::class, 'editlist'])->middleware('auth');

// DELETE STORE
Route::get('/income/deletecatlanding/{incat_slug}',[IncomeController::class, 'deletecatlanding'])->middleware('auth');
Route::get('/income/deletelistlanding/{income_slug}',[IncomeController::class, 'deletelistlanding'])->middleware('auth');

// DELETE
Route::get('/income/deletecategory/{incat_slug}',[IncomeController::class, 'deletecategory'])->middleware('auth');
Route::get('/income/deletelist/{income_slug}',[IncomeController::class, 'deletelist'])->middleware('auth');

// SEARCH
Route::get('/income/searchcat',[IncomeController::class, 'searchcat'])->middleware('auth');
Route::get('/income/searchlist',[IncomeController::class, 'searchlist'])->middleware('auth');

// PRINT
Route::get('/income/print', [IncomeController::class, 'printstore'])->middleware('auth');
Route::get('/income/print/search', [IncomeController::class, 'printsearch'])->middleware('auth');



/*
|--------------------------------------------------------------------------
| SOURCE OF EXPENSES
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// OPEN
Route::get('/expense', [ExpenseController::class, 'start'])->middleware('auth');
Route::get('/expense/entries/{entdata}', [ExpenseController::class, 'entries'])->middleware('auth');

// VIEW 
Route::get('/expense/viewlist/{excat_slug}',[ExpenseController::class, 'viewlist'])->middleware('auth');
Route::get('/expense/viewcategory/{expense_slug}',[ExpenseController::class, 'viewcategory'])->middleware('auth');

// CREATE
Route::post('/expense/addnew',[ExpenseController::class, 'addlist'])->middleware('auth');
Route::post('/expense/addcategory',[ExpenseController::class, 'addcategory'])->middleware('auth');

// UPDATE STORE
Route::get('/expense/editlanding/{excat_slug}',[ExpenseController::class, 'editcatlanding'])->middleware('auth');
Route::get('/expense/editstore/{expense_slug}',[ExpenseController::class, 'editstore'])->middleware('auth');

// UPDATE
Route::post('/expense/editcategory/{expense_slug}',[ExpenseController::class, 'editcategory'])->middleware('auth');
Route::post('/expense/editlist/{expense_slug}',[ExpenseController::class, 'editlist'])->middleware('auth');

// DELETE STORE
Route::get('/expense/deletecatlanding/{excat_slug}',[ExpenseController::class, 'deletecatlanding'])->middleware('auth');
Route::get('/expense/deletelistlanding/{expense_slug}',[ExpenseController::class, 'deletelistlanding'])->middleware('auth');

// DELETE
Route::get('/expense/deletecategory/{excat_slug}',[ExpenseController::class, 'deletecategory'])->middleware('auth');
Route::get('/expense/deletelist/{expense_slug}',[ExpenseController::class, 'deletelist'])->middleware('auth');

// SEARCH
Route::get('/expense/searchcat',[ExpenseController::class, 'searchcat'])->middleware('auth');
Route::get('/expense/searchlist',[ExpenseController::class, 'searchlist'])->middleware('auth');

// PRINT
Route::get('/expense/print', [ExpenseController::class, 'printstore'])->middleware('auth');
Route::get('/expense/print/search', [ExpenseController::class, 'printsearch'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| SOURCE OF DEBTS
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// OPEN
Route::get('/debt', [DebtController::class, 'start'])->middleware('auth');
Route::get('/debt/entries/{entdata}', [DebtController::class, 'entries'])->middleware('auth');

// VIEW 
Route::get('/debt/viewlist/{debcat_slug}',[DebtController::class, 'viewlist'])->middleware('auth');
Route::get('/debt/viewcategory/{debt_slug}',[DebtController::class, 'viewcategory'])->middleware('auth');

// CREATE
Route::post('/debt/addnew',[DebtController::class, 'addlist'])->middleware('auth');
Route::post('/debt/addcategory',[DebtController::class, 'addcategory'])->middleware('auth');

// UPDATE STORE
Route::get('/debt/editlanding/{debcat_slug}',[DebtController::class, 'editcatlanding'])->middleware('auth');
Route::get('/debt/editstore/{debt_slug}',[DebtController::class, 'editstore'])->middleware('auth');

// UPDATE
Route::post('/debt/editcategory/{debt_slug}',[DebtController::class, 'editcategory'])->middleware('auth');
Route::post('/debt/editlist/{debt_slug}',[DebtController::class, 'editlist'])->middleware('auth');

// DELETE   
Route::get('/debt/deletecatlanding/{debcat_slug}',[DebtController::class, 'deletecatlanding'])->middleware('auth');
Route::get('/debt/deletelistlanding/{debt_slug}',[DebtController::class, 'deletelistlanding'])->middleware('auth');

// DELETE
Route::get('/debt/deletecategory/{debcat_slug}',[DebtController::class, 'deletecategory'])->middleware('auth');
Route::get('/debt/deletelist/{debt_slug}',[DebtController::class, 'deletelist'])->middleware('auth');

// SEARCH
Route::get('/debt/searchcat',[DebtController::class, 'searchcat'])->middleware('auth');
Route::get('/debt/searchlist',[DebtController::class, 'searchlist'])->middleware('auth');

// PRINT
Route::get('/debt/print', [DebtController::class, 'printstore'])->middleware('auth');
Route::get('/debt/print/search', [DebtController::class, 'printsearch'])->middleware('auth');

// PAID DEBT
Route::get('/debt/paidlanding/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'paidlanding'])->middleware('auth');
Route::post('/debt/paiddebt/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'paiddebt'])->middleware('auth');






















