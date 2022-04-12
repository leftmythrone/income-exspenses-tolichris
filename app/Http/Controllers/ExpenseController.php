<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// MODEL
use App\Models\Expense;
use App\Models\ExpenseCategory;


class ExpenseController extends Controller
{
    public function start()
    {
        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => Expense::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "number" => 1,
            "subtotal" => 0,
            "total" => 0
        ]);
    }
}
