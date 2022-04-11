<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// MODEL
use App\Models\Income;


class IncomeController extends Controller
{
    public function start()
    {
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::all(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::all(),
            "subtotal" => 0,
        ]);
    }
}