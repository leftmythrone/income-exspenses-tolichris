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

Route::get('/', [UtilitiesController::class, 'login']);
Route::post('/authenticate', [UtilitiesController::class, 'authenticate']);


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
Route::get('/income', [IncomeController::class, 'start']);

// VIEW 
Route::get('/income/viewlist/{incat_slug}',[IncomeController::class, 'viewlist']);
Route::get('/income/viewcategory/{income_slug}',[IncomeController::class, 'viewcategory']);


// CREATE
Route::post('/income/addnew',[IncomeController::class, 'addlist']);
Route::post('/income/addcategory',[IncomeController::class, 'addcategory']);

// UPDATE
Route::get('/income/editlanding/{incat_slug}',[IncomeController::class, 'editcatlanding']);
Route::get('/income/editstore/{income_slug}',[IncomeController::class, 'editstore']);

Route::get('/income/editcategory/{income_slug}',[IncomeController::class, 'editcategory']);
Route::post('/income/editlist/{income_slug}',[IncomeController::class, 'editlist']);

// DELETE
Route::get('/income/deleteincome/{income_slug}',[IncomeController::class, 'deletelist']);
Route::get('/income/deletecategory/{incat_slug}',[IncomeController::class, 'deletecategory']);



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
Route::get('/expense', [ExpenseController::class, 'start']);

// VIEW 
Route::get('/expense/viewlist/{excat_slug}',[ExpenseController::class, 'viewlist']);
Route::get('/expense/viewcategory/{expense_slug}',[ExpenseController::class, 'viewcategory']);


// CREATE
Route::post('/expense/addnew',[ExpenseController::class, 'addlist']);
Route::post('/expense/addcategory',[ExpenseController::class, 'addcategory']);

// UPDATE
Route::get('/expense/editlanding/{excat_slug}',[ExpenseController::class, 'editcatlanding']);
Route::get('/expense/editstore/{expense_slug}',[ExpenseController::class, 'editstore']);

Route::get('/expense/editcategory/{expense_slug}',[ExpenseController::class, 'editcategory']);
Route::post('/expense/editlist/{expense_slug}',[ExpenseController::class, 'editlist']);

// DELETE
Route::get('/expense/deleteincome/{expense_slug}',[ExpenseController::class, 'deletelist']);
Route::get('/expense/deletecategory/{excat_slug}',[ExpenseController::class, 'deletecategory']);

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

Route::get('/debt', [\App\Http\Controllers\DebtController::class, 'start']);

// VIEW 
Route::get('/debt/viewlist/{debcat_slug}',[\App\Http\Controllers\DebtController::class, 'viewlist']);
Route::get('/debt/viewcategory/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'viewcategory']);


// CREATE
Route::post('/debt/addnew',[\App\Http\Controllers\DebtController::class, 'addlist']);
Route::post('/debt/addcategory',[\App\Http\Controllers\DebtController::class, 'addcategory']);

// UPDATE
Route::get('/debt/editlanding/{debcat_slug}',[\App\Http\Controllers\DebtController::class, 'editcatlanding']);
Route::get('/debt/editstore/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'editstore']);

Route::get('/debt/editcategory/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'editcategory']);
Route::post('/debt/editlist/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'editlist']);

// DELETE
Route::get('/debt/deletedebt/{debt_slug}',[\App\Http\Controllers\DebtController::class, 'deletelist']);
Route::get('/debt/deletecategory/{debcat_slug}',[\App\Http\Controllers\DebtController::class, 'deletecategory']);