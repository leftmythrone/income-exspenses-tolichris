<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// MODEL
use App\Models\Income;
use App\Models\Expense;
use App\Models\Debt;
use App\Models\User;

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

        User::create([
            'name' => 'Usman Tony',
            'username' => 'admin',
            'email' => 'tolichris@gmail.com',
            'password' => '11111'
        ]);

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF FACTORY
        |-------------------------------------------------------------------------- 
        */

        // \App\Models\User::factory(10)->create();
        
        Income::factory(1)->create();

        Expense::factory(1)->create();

        Debt::factory(1)->create();

        \App\Models\IncomeCategory::create([
            'name' => 'Income getting started',
            'incat_slug' => 'basic.sVasidwadswUsa',
            'incat_entry_date' => 'Thursday, 28-Apr-2022'
        ]);

        \App\Models\ExpenseCategory::create([
            'name' => 'Expense getting started',
            'excat_slug' => 'basic.sgsdfAODsadcma',
            'excat_entry_date' => 'Thursday, 28-Apr-2022'
        ]);

        \App\Models\DebtCategory::create([
            'name' => 'Debt getting started',
            'debcat_slug' => 'basic.DFiaskdmaWoew',
            'debcat_entry_date' => 'Thursday, 28-Apr-2022'
        ]);


        /*
        |--------------------------------------------------------------------------
        | SOURCE OF INCOME SEEDER
        |--------------------------------------------------------------------------
        */


        // \App\Models\IncomeCategory::create([
        //     'name' => 'Pendapapatan Bunga',
        //     'incat_slug' => '23uhuhddshfdank',
        //     'incat_entry_date' => 'Thursday, 28-Apr-2022'
        // ]);

        // \App\Models\IncomeCategory::create([
        //     'name' => 'Laba Penjualan Aktiva Tetap ',
        //     'incat_slug' => 'gdjnnasl@24w2asdd',
        //     'incat_entry_date' => 'Thursday, 28-Apr-2022'
        // ]);

        // \App\Models\IncomeCategory::create([
        //     'name' => 'Pendapapatan Royalti',
        //     'incat_slug' => 'asdaszasdsa',
        //     'incat_entry_date' => 'Thursday, 28-Apr-2022'
        // ]);

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF EXPENSE SEEDER
        |--------------------------------------------------------------------------
        */

        // \App\Models\ExpenseCategory::create([
        //     'name' => 'Pengeluaran Tetap',
        //     'excat_slug' => 'asdaszasdsa',
        //     'excat_entry_date' => 'Thursday, 28-Apr-2022'
            
        // ]);

        // \App\Models\ExpenseCategory::create([
        //     'name' => 'Pengeluaran Tidak Tetap',
        //     'excat_slug' => 'sdgsgdsgger',
        //     'excat_entry_date' => 'Thursday, 28-Apr-2022'
            
        // ]);

        // \App\Models\ExpenseCategory::create([
        //     'name' => 'Pengeluaran Lainnya',
        //     'excat_slug' => 'gdfghdttrb',
        //     'excat_entry_date' => 'Thursday, 28-Apr-2022'
            
        // ]);

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF DEBT SEEDER
        |--------------------------------------------------------------------------
        */

        // \App\Models\DebtCategory::create([
        //     'name' => 'Utang Pajak',
        //     'debcat_slug' => 'gdfghdttrb',
        //     'debcat_entry_date' => 'Thursday, 28-Apr-2022'
        // ]);

        // \App\Models\DebtCategory::create([
        //     'name' => 'Utang Biaya',
        //     'debcat_slug' => 'sfsdgdfhtht',
        //     'debcat_entry_date' => 'Thursday, 28-Apr-2022'
        // ]);

        // \App\Models\DebtCategory::create([
        //     'name' => 'Utang Wesel',
        //     'debcat_slug' => 'budbudrwAWWesaw',
        //     'debcat_entry_date' => 'Thursday, 28-Apr-2022'
        // ]);

    }
}
