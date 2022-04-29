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
        */

        // \App\Models\User::factory(10)->create();
        
        Income::factory(10)->create();

        Expense::factory(3)->create();

        Debt::factory(2)->create();

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF INCOME SEEDER
        |--------------------------------------------------------------------------
        */

        \App\Models\IncomeCategory::create([
            'name' => 'Pendapapatan Bunga',
            'incat_slug' => '23uhuhddshfdank',
            'incat_entry_date' => 'Thursday, 28-Apr-2022'
        ]);

        \App\Models\IncomeCategory::create([
            'name' => 'Laba Penjualan Aktiva Tetap ',
            'incat_slug' => 'gdjnnasl@24w2asdd',
            'incat_entry_date' => 'Thursday, 28-Apr-2022'
        ]);

        \App\Models\IncomeCategory::create([
            'name' => 'Pendapapatan Royalti',
            'incat_slug' => 'asdaszasdsa',
            'incat_entry_date' => 'Thursday, 28-Apr-2022'
        ]);

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF EXPENSE SEEDER
        |--------------------------------------------------------------------------
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
