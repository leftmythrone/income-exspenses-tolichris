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

    /*
    |--------------------------------------------------------------------------
    | INCOME UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function start()
    {
        // SOURCE INCOME DATABASE
        $incomes = DB::table('incomes')
        ->select('income_nominal', 'accounts.account_name')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->get();

        // SOURCE EXPENSE DATABASE
        $expenses = DB::table('expenses')
        ->select('expense_nominal', 'accounts.account_name')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->get();

        // SOURCE DEBTS DATABASE
        $debts = DB::table('debts')
        ->select('debt_nominal', 'accounts.account_name')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->get();


        return view('/pages/accounts/accounts', [
            
            // Title
            "title" => "Account",
            
            // Account
            "accounts" => Account::latest('created_at')->get(),
            
            // Counting
            "incomes" => $incomes,
            "expenses" => $expenses,
            "debts" => $debts, 

            // List
            "number" => 1,
            "subcat" => 0,
            "subtotal" => 0,
            "total" => 0
        ]);

    }

    /*
    |--------------------------------------------------------------------------
    | INCOME UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function create($account_slug)
    {

    }

    public function store()
    {

    }

    /*
    |--------------------------------------------------------------------------
    | INCOME UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function sum($account_slug)
    {
        $crud = DB::table('accounts')->where('account_slug',$account_slug)->get();
    }

    public function summation($account_slug)
    {
        DB::table('accounts')->where('account_slug', $account_slug)->update([
            'account_balance'=>$request->input_nominal + $request->input_balance 
		]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */
    
    public function sub($account_slug)
    {
        $crud = DB::table('accounts')->where('account_slug',$account_slug)->get();
    }

    public function substraction($account_slug)
    {
        DB::table('accounts')->where('account_slug', $account_slug)->update([
            'account_balance'=>$request->input_nominal - $request->input_balance 
		]);

    }

    /*
    |--------------------------------------------------------------------------
    | INCOME UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function edit($account_slug)
    {
        $crud = DB::table('accounts')->where('account_slug',$account_slug)->get();
    }

    public function update($account_slug)
    {
        DB::table('accounts')->where('account_slug', $account_slug)->update([
            'account_name'=>$request->input_name,
            'account_balance'=>$request->input_balance,
            'account_slug'=>$request->inpat_slug
		]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function find($account_slug)
    {
        $crud = DB::table('accounts')->where('account_slug',$account_slug)->get();
    }

    public function delete($account_slug)
    {
        DB::table('accounts')->where('account_slug',$account_slug)->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function fresh()
    {
        // INCOMES CLEAR ALL DATABASE
        DB::table('incomes')->truncate();

        // EXPENSE CLEAR ALL DATABASE
        DB::table('expenses')->truncate();

        // DEBTS CLEAR ALL DATABASE
        DB::table('debts')->truncate();


    }
}
