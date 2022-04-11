<?php

use Illuminate\Support\Facades\Route;

// MODELS
use App\Models\Income;
use App\Models\Login;

// CONTROLLLER
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

Route::get('/login', [OtherController::class, 'login']);

Route::get('/forget', [OtherController::class, 'forget']);

Route::get('/home', [OtherController::class, 'home']);


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

Route::get('/expense', function () {
    return view('/pages/expenses/expenses', [
        "title" => "Outcomes"
    ]);
});

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

Route::get('/debt', function () {
    return view('/pages/debts/debts', [
        "title" => "Debts"
    ]);
});