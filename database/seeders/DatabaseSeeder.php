<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// MODEL
use App\Models\Income;
use App\Models\Expense;
use App\Models\Debt;

// MODEL CATEGORY
use App\Models\IncomeCategory;
use App\Models\ExpenseCategory;
use App\Models\DebtCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF FACTORY
        |--------------------------------------------------------------------------
        |
        | Here is where you can register web routes for your application. These
        | routes are loaded by the RouteServiceProvider within a group which
        | contains the "web" middleware group. Now create something great!
        | 
        */

        // \App\Models\User::factory(10)->create();
        
        Income::factory(10)->create();

        Expense::factory(10)->create();

        Debt::factory(10)->create();

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF INCOME SEEDER
        |--------------------------------------------------------------------------
        |
        | Here is where you can register web routes for your application. These
        | routes are loaded by the RouteServiceProvider within a group which
        | contains the "web" middleware group. Now create something great!
        |
        */

        \App\Models\IncomeCategory::create([
            'name' => 'Pendapapatan Bunga',
        ]);

        \App\Models\IncomeCategory::create([
            'name' => 'Laba Penjualan Aktiva Tetap ',
        ]);

        \App\Models\IncomeCategory::create([
            'name' => 'Pendapapatan Royalti',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF EXPENSE SEEDER
        |--------------------------------------------------------------------------
        |
        | Here is where you can register web routes for your application. These
        | routes are loaded by the RouteServiceProvider within a group which
        | contains the "web" middleware group. Now create something great!
        |
        */

        \App\Models\ExpenseCategory::create([
            'name' => 'Pengeluaran Tetap',
        ]);

        \App\Models\ExpenseCategory::create([
            'name' => 'Pengeluaran Tidak Tetap',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF DEBT SEEDER
        |--------------------------------------------------------------------------
        |
        | Here is where you can register web routes for your application. These
        | routes are loaded by the RouteServiceProvider within a group which
        | contains the "web" middleware group. Now create something great!
        |
        */

        \App\Models\DebtCategory::create([
            'name' => 'Utang Pajak',
        ]);

        \App\Models\DebtCategory::create([
            'name' => 'Utang Biaya',
        ]);

        \App\Models\DebtCategory::create([
            'name' => 'Utang Wesel',
        ]);

    }
}
