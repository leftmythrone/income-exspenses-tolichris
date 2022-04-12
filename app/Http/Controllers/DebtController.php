<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// MODEL
use App\Models\Debt;
use App\Models\DebtCategory;

class DebtController extends Controller
{
    public function start()
    {
        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "number" => 1,
            "subtotal" => 0,
            "total" => 0
        ]);
    }
}
