<?php

use Illuminate\Support\Facades\Route;

// MODELS
use App\Models\Income;
use App\Models\Expense;
use App\Models\Debt;
use App\Models\Login;

// CONTROLLLER
use App\Http\Controllers\UtilitiesController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\ContrHttp\Controllers\DebtController;

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

Route::get('/', [UtilitiesController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UtilitiesController::class, 'authenticate']);

Route::get('/logout', [UtilitiesController::class, 'logout'])->middleware('auth');



Route::get('/register', [UtilitiesController::class, 'register']);
Route::post('/registerstore', [UtilitiesController::class, 'registerstore']);



Route::get('/mychart', [UtilitiesController::class, 'chart']);

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

// VIEW 
Route::get('/income/viewlist/{incat_slug}',[IncomeController::class, 'viewlist'])->middleware('auth');
Route::get('/income/viewcategory/{income_slug}',[IncomeController::class, 'viewcategory'])->middleware('auth');


// CREATE
Route::post('/income/addnew',[IncomeController::class, 'addlist'])->middleware('auth');
Route::post('/income/addcategory',[IncomeController::class, 'addcategory'])->middleware('auth');

// UPDATE
Route::get('/income/editlanding/{incat_slug}',[IncomeController::class, 'editcatlanding'])->middleware('auth');
Route::get('/income/editstore/{income_slug}',[IncomeController::class, 'editstore'])->middleware('auth');

Route::get('/income/editcategory/{income_slug}',[IncomeController::class, 'editcategory'])->middleware('auth');
Route::post('/income/editlist/{income_slug}',[IncomeController::class, 'editlist'])->middleware('auth');

// DELETE
Route::get('/income/deleteincome/{income_slug}',[IncomeController::class, 'deletelist'])->middleware('auth');
Route::get('/income/deletecategory/{incat_slug}',[IncomeController::class, 'deletecategory'])->middleware('auth');



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

// VIEW 
Route::get('/expense/viewlist/{excat_slug}',[ExpenseController::class, 'viewlist'])->middleware('auth');
Route::get('/expense/viewcategory/{expense_slug}',[ExpenseController::class, 'viewcategory'])->middleware('auth');


// CREATE
Route::post('/expense/addnew',[ExpenseController::class, 'addlist'])->middleware('auth');
Route::post('/expense/addcategory',[ExpenseController::class, 'addcategory'])->middleware('auth');

// UPDATE
Route::get('/expense/editlanding/{excat_slug}',[ExpenseController::class, 'editcatlanding'])->middleware('auth');
Route::get('/expense/editstore/{expense_slug}',[ExpenseController::class, 'editstore'])->middleware('auth');

Route::get('/expense/editcategory/{expense_slug}',[ExpenseController::class, 'editcategory'])->middleware('auth');
Route::post('/expense/editlist/{expense_slug}',[ExpenseController::class, 'editlist'])->middleware('auth');

// DELETE
Route::get('/expense/deleteincome/{expense_slug}',[ExpenseController::class, 'deletelist'])->middleware('auth');
Route::get('/expense/deletecategory/{excat_slug}',[ExpenseController::class, 'deletecategory'])->middleware('auth');

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

Route::get('/debt', [\App\Http\Controllers\DebtController::class, 'start'])->middleware('auth');

// VIEW 
Route::get('/debt/viewlist/{debcat_slug}',[\App\Http\Controllers\DebtController::class, 'viewlist'])->middleware('auth');
Route::get('/debt/viewcategory/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'viewcategory'])->middleware('auth');


// CREATE
Route::post('/debt/addnew',[\App\Http\Controllers\DebtController::class, 'addlist'])->middleware('auth');
Route::post('/debt/addcategory',[\App\Http\Controllers\DebtController::class, 'addcategory'])->middleware('auth');

// UPDATE
Route::get('/debt/editlanding/{debcat_slug}',[\App\Http\Controllers\DebtController::class, 'editcatlanding'])->middleware('auth');
Route::get('/debt/editstore/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'editstore'])->middleware('auth');

Route::get('/debt/editcategory/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'editcategory'])->middleware('auth');
Route::post('/debt/editlist/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'editlist'])->middleware('auth');

// DELETE
Route::get('/debt/deletedebt/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'deletelist'])->middleware('auth');
Route::get('/debt/deletecategory/{debcat_slug}',[\App\Http\Controllers\DebtController::class, 'deletecategory'])->middleware('auth');