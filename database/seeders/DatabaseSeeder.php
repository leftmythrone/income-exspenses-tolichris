<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// MODEL
use App\Models\Income;
use App\Models\IncomeCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Income::factory(4)->create();

        Income::create([
            'income_description' => 'Cargo Evergreen dari',
            'income_category_id' => 1,
            'income_type_id' => 2,
            'nominal' => 50000
        ]);

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

    }
}
