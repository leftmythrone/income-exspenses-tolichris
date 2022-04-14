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

Route::get('/login', [UtilitiesController::class, 'login']);

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

Route::get('/', [IncomeController::class, 'start']);

Route::get('/income/addnew',[IncomeController::class, 'addnew']);
Route::get('/income/edit/{id}',[IncomeController::class, 'edit']);
Route::post('/income/update',[IncomeController::class, 'update']);
//Untuk Aksi Hapus Data
Route::get('/income/hapus/{id}',[IncomeController::class, 'hapus']);


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