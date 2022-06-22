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
            'account_name' => 'BCA',
            'account_balance' => 0,
            'account_slug' => Hash::make('basic.adminbca'),
        ]);

        Account::create([
            'account_name' => 'Kas Kecil',
            'account_balance' => 0,
            'account_slug' => Hash::make('basic.adminkaskecil'),
        ]);

        Account::create([
            'account_name' => 'Kas Besar',
            'account_balance' => 0,
            'account_slug' => Hash::make('basic.adminkasbesar'),
        ]);

        Account::create([
            'account_name' => 'Kredit',
            'account_balance' => 0,
            'account_slug' => Hash::make('basic.adminkredit'),
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
            'incat_name' => '[Click Edit Or Delete]',
            'incat_slug' => 'basic.sVasidwadswUsa',
            'incat_entry_date' => '2022-05-21'
        ]);

        // Income::factory(10)->create();


        \App\Models\Income::create([
            'income_description' => '[Basic Income List]',
            'income_category_id' => 1,
            'income_account_id' => 1,
            'income_slug' => 'basic.asd@4$r34dsdfasa',
            'income_nominal' => 0,
            'income_entry_date' => '2022-05-21'
        ]);


        /*
        |--------------------------------------------------------------------------
        | SOURCE OF EXPENSE SEEDER
        |--------------------------------------------------------------------------
        */

        \App\Models\ExpenseCategory::create([
            'excat_name' => '[Click Edit Or Delete]',
            'excat_slug' => 'basic.sVasidwadswUsa',
            'excat_entry_date' => '2022-05-21'
        ]);

        // Expense::factory(10)->create();

        \App\Models\Expense::create([
            'expense_description' => '[Basic Expense List]',
            'expense_category_id' => 1,
            'expense_account_id' => 1,
            'expense_slug' => 'basic.asd@4$r34dsdfasa',
            'expense_nominal' => 0, 
            'expense_entry_date' => '2022-05-21'
        ]);

        /*
        |--------------------------------------------------------------------------
        | SOURCE OF DEBT SEEDER
        |--------------------------------------------------------------------------
        */

        \App\Models\DebtCategory::create([
            'debcat_name' => '[Click Edit Or Delete]',
            'debcat_slug' => 'basic.sVasidwadswUsa',
            'debcat_entry_date' => '2022-05-21'
        ]);

        // Debt::factory(10)->create();

        \App\Models\Debt::create([
            'debt_description' => '[Basic Debt List]',
            'debt_category_id' => 1,
            'debt_account_id' => 1,
            'debt_slug' => 'basic.asd@4$r34dsdfasa',
            'debt_nominal' => 0,
            'debt_entry_date' => '2022-05-21'
        ]);


    }
}
