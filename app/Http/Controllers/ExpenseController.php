<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// MODEL
use App\Models\Expense;
use App\Models\ExpenseCategory;

class ExpenseController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INCOME MAIN PAGE
    |--------------------------------------------------------------------------
    */

    public function start()
    {
        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => Expense::latest()->get(),
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 0,
            "excats"=> Expense::latest()->get(),
            "lists" => Expense::latest(),
            "inviews" => Expense::latest()->get(),

        ]);
    }

        /*
    |--------------------------------------------------------------------------
    | INCOME TO VIEW CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function viewcategory($excat_slug)
    {
        $category = DB::table('expense_categories')->where('excat_slug',$excat_slug)->get();

        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => Expense::latest()->get(),
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 2,
            "excats" => $category,
            "lists" => Expense::latest(),
            "inviews" => Expense::latest()->get(),
            
        ]);
    }

    public function viewlist($expense_slug)
    {
        $inviews = DB::table('expenses')
        ->select('expense_description', 'expense_categories.name' ,'nominal')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->where('expenses.expense_slug',$expense_slug)
        ->get();


        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => Expense::latest()->get(),
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 4,
            "excats" => \App\Models\ExpenseCategory::latest()->get(),
            "lists" => Expense::latest(),
            "inviews" => $inviews,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | INCOME TO CREATE NEW CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function addcategory(Request $request)
    {
        DB::table('expense_categories')->insert([
            'name'=>$request->excat_name,
            'excat_entry_date'=>$request->excat_date,
            'excat_slug'=>$request->excat_slug
        ]);
        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "expenses" => Expense::latest()->get(),
            "excats"=> Expense::latest()->get(),
            "lists" => Expense::latest(),
            "inviews" => Expense::latest()->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 0,


        ]);
    }


    public function addlist(Request $request)
    {
        DB::table('expenses')->insert([
            'expense_description'=>$request->input_decs,
            'expense_category_id' => $request->input_cats,
            'expense_entry_date' => $request-> input_date,
            'expense_slug' => $request-> expense_slug,
            'nominal' => $request-> input_nominal
        ]);
        
        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "expenses" => Expense::latest()->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 0,
            "excats"=> Expense::latest()->get(),
            "lists" => Expense::latest(),
            "inviews" => Expense::latest()->get(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */
    public function editcatlanding($excat_slug)
    {
        $category = DB::table('expense_categories')->where('excat_slug',$excat_slug)->get();

        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => Expense::latest()->get(),
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 1,
            "excats" => $category,
            "inviews" => Expense::latest()->get(),
            "lists" => Expense::latest(),
            "update" => null
        ]);
    }

    public function editstore($expense_slug)
    {
        $list = DB::table('expenses')->where('expense_slug',$expense_slug)->get();

        // $test = DB::table('expenses')
        // ->select('*', 'income_categories.name')
        // ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        // ->where('expenses.income_slug',$income_slug)
        // ->get();

        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => Expense::latest()->get(),
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 3,
            "excats" => \App\Models\ExpenseCategory::latest()->get(),
            "inviews" => Expense::latest()->get(),
            "update" => null,
            "lists" => $list
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME TO UPDATE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function editcategory(Request $request, $excat_slug)
    {
        DB::table('expense_categories')->where('excat_slug', $excat_slug)->update([
            'name'=>$request->excat_name
		]);
        
        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => Expense::latest()->get(),
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 0,
            "excats"=> Expense::latest()->get(),
            "inviews" => Expense::latest()->get(),
            "lists" => Expense::latest(),
        ]);
    }

    public function editlist(Request $request, $expense_slug)
    {
        DB::table('expenses')->where('expense_slug', $expense_slug)->update([
            'expense_description'=>$request->input_decs,
            'expense_category_id' => $request->input_cats,
            'expense_entry_date' => $request-> input_date,
            'expense_slug' => $request-> expense_slug,
            'nominal' => $request-> input_nominal
		]);
        
        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => Expense::latest()->get(),
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 0,
            "excats"=> Expense::latest()->get(),
            "inviews" => Expense::latest()->get(),
            "lists" => Expense::latest(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME TO DELETE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function deletelist($expense_slug)
    {
        DB::table('expenses')->where('expense_slug',$expense_slug)->delete();        

        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => Expense::latest()->get(),
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 0,
            "excats"=> Expense::latest()->get(),
            "lists" => Expense::latest(),
            "inviews" => Expense::latest()->get(),

        ]);
    }

    public function deletecategory($excat_slug)
    {
        DB::table('expense_categories')->where('excat_slug',$excat_slug)->delete();
        

        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => Expense::latest()->get(),
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 0,
            "excats"=> Expense::latest()->get(),
            "lists" => Expense::latest(),
            "inviews" => Expense::latest()->get(),

        ]);
    }
}