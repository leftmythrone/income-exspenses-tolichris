<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// MODEL
use App\Models\Income;
use App\Models\IncomeCategory;



class IncomeController extends Controller
{
    public function start()
    {
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "number" => 1,
            "subtotal" => 0,
            "total" => 0
        ]);
    }

    public function addnew(Request $request)
    {

        DB::table('incomes')->insert([
            'id_barang'=>$request->income_descripton,
            'nama_barang' => $request->nominal
        ]);
        return view('/pages/incomes/incomes', [
        ]);
    }

    public function edit($id)
    {
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "number" => 1,
            "subtotal" => 0,
            "total" => 0
        ]);
    }

    public function update()
    {
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "number" => 1,
            "subtotal" => 0,
            "total" => 0
        ]);
    }

    public function hapus()
    {
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "number" => 1,
            "subtotal" => 0,
            "total" => 0
        ]);
    }
}