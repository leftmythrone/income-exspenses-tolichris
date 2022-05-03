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
use App\Http\Controllers\DebtController;

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

Route::get('/debt', [IncomeController::class, 'start']);

// VIEW 
Route::get('/debt/viewlist/{incat_slug}',[IncomeController::class, 'viewlist']);
Route::get('/debt/viewcategory/{income_slug}',[IncomeController::class, 'viewcategory']);


// CREATE
Route::post('/debt/addnew',[IncomeController::class, 'addlist']);
Route::post('/debt/addcategory',[IncomeController::class, 'addcategory']);

// UPDATE
Route::get('/debt/editlanding/{incat_slug}',[IncomeController::class, 'editcatlanding']);
Route::get('/debt/editstore/{income_slug}',[IncomeController::class, 'editstore']);

Route::get('/debt/editcategory/{income_slug}',[IncomeController::class, 'editcategory']);
Route::post('/debt/editlist/{income_slug}',[IncomeController::class, 'editlist']);

// DELETE
Route::get('/debt/deleteincome/{income_slug}',[IncomeController::class, 'deletelist']);
Route::get('/debt/deletecategory/{incat_slug}',[IncomeController::class, 'deletecategory']);