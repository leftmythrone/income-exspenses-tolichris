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
                        "historycat" => null,
            "historylist" =>null,

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME SEARCH
    |--------------------------------------------------------------------------
    */

    public function searchcat()
    {
        $search = \App\Models\ExpenseCategory::latest();

        if(request('searchcat')) {
            $search->where('name', 'like', '%' . request('searchcat') . '%');
        }

        $historycat = request('searchcat');

        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => Expense::latest()->get(),
            // "expense" => Expense::where('income_entry_date', date("l, d-M-Y"))->get(),
            // "categories" => \App\Models\ExpenseCategory::latest()->get(),
            "categories" => $search->get(),
            // "categories" => \App\Models\ExpenseCategory::where('incat_entry_date', date("l, d-M-Y"))->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 0,
            "excats"=> Expense::latest()->get(),
            "lists" => Expense::latest(),
            // "lists" => Expense::where('income_entry_date', date("l, d-M-Y"))->get(),
            "inviews" => Expense::latest()->get(),
            "historycat" => $historycat,
            "historylist" =>null,

        ]);
    }

    public function searchlist()
    {
        $search = \App\Models\Expense::latest();

        if(request('searchlist')) {
            $search->where('expense_description', 'like', '%' . request('searchlist') . '%');
        }

        $historylist = request('searchlist');

        return view('/pages/expenses/expenses', [
            "title" => "Expense",
            "sidebars" => "partials.sidebar",
            "expenses" => $search->get(),
            // "expense" => Expense::where('income_entry_date', date("l, d-M-Y"))->get(),
            "categories" => \App\Models\ExpenseCategory::latest()->get(),
            // "categories" => \App\Models\ExpenseCategory::where('incat_entry_date', date("l, d-M-Y"))->get(),
            "dataopt" => \App\Models\ExpenseCategory::latest()->get(),
            "editcategoryjs" => 0,
            "excats"=> Expense::latest()->get(),
            "lists" => Expense::latest(),
            // "lists" => Expense::where('income_entry_date', date("l, d-M-Y"))->get(),
            "inviews" => Expense::latest()->get(),
            "historycat" =>null,
            "historylist" => $historylist,

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
                        "historycat" => null,
            "historylist" =>null,
            
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
                        "historycat" => null,
            "historylist" =>null,
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
                        "historycat" => null,
            "historylist" =>null,


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
                        "historycat" => null,
            "historylist" =>null,
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
                        "historycat" => null,
            "historylist" =>null,
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
            "historycat" => null,
            "historylist" =>null,
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
                        "historycat" => null,
            "historylist" =>null,
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
                        "historycat" => null,
            "historylist" =>null,
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
                        "historycat" => null,
            "historylist" =>null,

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
                        "historycat" => null,
            "historylist" =>null,

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | EXPENSE TO PRINT
    |--------------------------------------------------------------------------
    */

    public function printstore()
    {      
        $alldata = DB::table('expenses')
        ->select('expense_description', 'expense_categories.name' ,'nominal','expense_entry_date')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        // ->where('expense.income_slug','income_slug')
        ->get();
        
        return view('/pages/expenses/print', [
            "title" => "Expense",
            "bck" => "expense",
            "number" => 1,
            "total" => 0,
            "expenses" => $alldata
        ]);
    }
}