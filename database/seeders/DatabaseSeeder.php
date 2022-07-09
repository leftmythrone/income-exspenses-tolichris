<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// MODEL
use App\Models\Income;
use App\Models\Expense;
use App\Models\Debt;
use App\Models\User;
use App\Models\Account;
use App\Models\Dump;



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
        | SOURCE OF ACCOUNT SEEDER
        |--------------------------------------------------------------------------
        */   
        
        Dump::create([
            'income_slug' => 'Dump Data',
            'expense_slug' => 'Dump Data',
            'debt_slug' => 'Dump Data',
            'incat_slug' => 'Dump Data',
            'excat_slug' => 'Dump Data',
            'debcat_slug' => 'Dump Data'
        ]);

        Account::create([
            'account_name' => 'Bank Central Asia',
            'account_balance' => 0,
            'account_slug' => uniqid('gfg', true),
        ]);

        Account::create([
            'account_name' => 'Bank Negara Indonesia',
            'account_balance' => 0,
            'account_slug' => uniqid('gfg', true),
        ]);

        Account::create([
            'account_name' => 'Bank Rakyat Indonesia',
            'account_balance' => 0,
            'account_slug' => uniqid('gfg', true),
        ]);

        Account::create([
            'account_name' => 'Permata Bank',
            'account_balance' => 0,
            'account_slug' => uniqid('gfg', true),
        ]);
            
        /*
        |--------------------------------------------------------------------------
        | SOURCE OF USER SEEDER
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Usman Tony',
            'username' => 'admin',
            'user_slug' => 'basic.useradmin',
            'password' => Hash::make('tlc111')
        ]);

        // \App\Models\User::factory(10)->create();

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF INCOME SEEDER
        |--------------------------------------------------------------------------
        */


        \App\Models\IncomeCategory::create([
            'incat_name' => 'Pendapatan Aktif',
            'incat_slug' => uniqid('gfg', true),
            'incat_entry_date' => '2022-05-21'
        ]);

        \App\Models\IncomeCategory::create([
            'incat_name' => 'Pendapatan Pasif',
            'incat_slug' => uniqid('gfg', true),
            'incat_entry_date' => '2022-05-21'
        ]);

        \App\Models\IncomeCategory::create([
            'incat_name' => 'Pendapatan Investasi',
            'incat_slug' => uniqid('gfg', true),
            'incat_entry_date' => '2022-05-21'
        ]);
        Income::factory(20)->create();


        \App\Models\Income::create([
            'income_description' => '[Basic Income List]',
            'income_category_id' => 1,
            'income_account_id' => 1,
            'income_slug' => uniqid('gfg', true),
            'income_nominal' => 10,
            'income_entry_date' => '2022-05-21'
        ]);


        /*
        |--------------------------------------------------------------------------
        | SOURCE OF EXPENSE SEEDER
        |--------------------------------------------------------------------------
        */

        \App\Models\ExpenseCategory::create([
            'excat_name' => 'Pengeluaran Tetap',
            'excat_slug' => uniqid('gfg', true),
            'excat_entry_date' => '2022-05-21'
        ]);

        \App\Models\ExpenseCategory::create([
            'excat_name' => 'Pengeluaran Tidak Tetap',
            'excat_slug' => uniqid('gfg', true),
            'excat_entry_date' => '2022-05-21'
        ]);
        Expense::factory(2)->create();

        \App\Models\Expense::create([
            'expense_description' => '[Basic Expense List]',
            'expense_category_id' => 1,
            'expense_account_id' => 1,
            'expense_slug' => uniqid('gfg', true),
            'expense_nominal' => 0, 
            'expense_entry_date' => '2022-05-21'
        ]);

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF DEBT SEEDER
        |--------------------------------------------------------------------------
        */

        \App\Models\DebtCategory::create([
            'debcat_name' => 'Utang Pajak',
            'debcat_slug' => uniqid('gfg', true),
            'debcat_entry_date' => '2022-05-21'
        ]);

        \App\Models\DebtCategory::create([
            'debcat_name' => 'Utang Biaya',
            'debcat_slug' => uniqid('gfg', true),
            'debcat_entry_date' => '2022-05-21'
        ]);

        \App\Models\DebtCategory::create([
            'debcat_name' => 'Utang Wesel',
            'debcat_slug' => uniqid('gfg', true),
            'debcat_entry_date' => '2022-05-21'
        ]);

        Debt::factory(2)->create();

        \App\Models\Debt::create([
            'debt_description' => '[Basic Debt List]',
            'debt_category_id' => 1,
            'debt_account_id' => 1,
            'debt_slug' => uniqid('gfg', true),
            'debt_nominal' => 0,
            'debt_entry_date' => '2022-05-21'
        ]);


    }
}
