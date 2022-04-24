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
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/income', [IncomeController::class, 'start']);

Route::post('/income/addnew',[IncomeController::class, 'addnew']);
Route::post('/income/addcategory',[IncomeController::class, 'addcategory']);

Route::get('/income/edit/{id}',[IncomeController::class, 'edit']);
Route::post('/income/update',[IncomeController::class, 'update']);

Route::get('/income/deleteincome/{income_token}',[IncomeController::class, 'deleteincome']);
Route::get('/income/deletecategory/{incat_entry_token}',[IncomeController::class, 'deletecategory']);

//Untuk Aksi Hapus Data



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

// Route::get('/expense', function () {
//     return view('/pages/expenses/expenses', [
//         "title" => "Outcomes"
//     ]);
// });

Route::get('/expense', [ExpenseController::class, 'start']);

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

// Route::get('/debt', function () {
//     return view('/pages/debts/debts', [
//         "title" => "Debts"
//     ]);
// });

Route::get('/debt', [DebtController::class, 'start']);