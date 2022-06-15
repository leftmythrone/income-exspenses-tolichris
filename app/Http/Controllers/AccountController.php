<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


// MODEL
use App\Models\User;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Debt;

// MODEL CATEGORY
use App\Models\IncomeCategory;
use App\Models\ExpenseCategory;
use App\Models\DebtCategory;

// MAIN ACCOUNT
use App\Models\Account;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function start()
    {
        $incomes = DB::table('incomes')
        ->select('nominal', 'accounts.account_name')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->get();

        // $expenses = DB::table('expenses')
        // ->select('nominal', 'accounts.account_name')
        // ->join('accounts', 'accounts.id', '=', 'income_account_id')
        // ->get();

        // $debts = DB::table('debts')
        // ->select('nominal', 'accounts.account_name')
        // ->join('accounts', 'accounts.id', '=', 'income_account_id')
        // ->get();

        // $truncome = DB::table('incomes')->truncate();

        return view('/pages/accounts/accounts', [
            
            // Title
            "title" => "Income",
            
            // Account
            "accounts" => Account::latest()->get(),

            // 
            "incats" => IncomeCategory::latest()->get(),
            
            // Counting
            "incomes" => $incomes, 
            "number" => 1,
            "subcat" => 0,
            "subtotal" => 0,
            "total" => 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
