<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

// MODEL
use App\Models\User;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Debt;

// MODEL CATEGORY
use App\Models\IncomeCategory;
use App\Models\ExpenseCategory;
use App\Models\DebtCategory;

class UtilitiesController extends Controller
{
    public function login()
    {
        return view('/pages/utilities/login', [
            "title" => "Login"
        ]);
    }

    public function chart()
    {
        return view('/pages/utilities/mychart', [
            "title" => "My Chart",
            "incomes" => Income::latest()->get(),
            "expenses" => Expense::latest()->get(),
            "debts" => Debt::latest()->get(),
            "incats" => \App\Models\IncomeCategory::latest()->get(),
            "excats" => \App\Models\ExpenseCategory::latest()->get(),
            "debcats" => \App\Models\DebtCategory::latest()->get(),
            "number" => 0,
            "subtotal" => 0,
            "total" => 0,
            "intotal" => 0,
            "extotal" => 0,
            "debtotal" => 0,
            "cashflow" => 0
        ]);
    }
}
