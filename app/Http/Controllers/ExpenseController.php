<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// MODEL
use App\Models\Account;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Dump;

class ExpenseController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INCOME MAIN PAGE
    |--------------------------------------------------------------------------
    */

    public function start()
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();


        return view('/pages/expenses/expenses', [
            
            // Title 
            "title" => "Expense",

            // Main table view
            "expenses" => $expenses,
            "categories" => \App\Models\ExpenseCategory::latest('excat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\ExpenseCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "excats"=> $dummies,
            "lists" => $dummies,
            "inviews" => $dummies,

            // History for search
            "historycat" => null, 
            "historylist" =>null, 

            // For JavaScript show 
            "editcategoryjs" => 0,

            // For showing entries
            "entdata" => 0,
            
        ]);
    }


    public function entries(Request $request, $entdata)
    {

        if ($request->type === 'next')
        {
            $count = $entdata + 10;
        }
        else
        {
            $count = $entdata - 10;
        }


        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();

        // RUMUS TAEK


        return view('/pages/expenses/expenses', [
            
            // Title 
            "title" => "Expense",

            // Main table view
            "expenses" => $expenses,
            "categories" => \App\Models\ExpenseCategory::latest('excat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\ExpenseCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "excats"=> $dummies,
            "lists" => $dummies,
            "inviews" => $dummies,

            // History for search
            "historycat" => null, 
            "historylist" => null, 

            // For JavaScript show 
            "editcategoryjs" => 0,

            // For showing entries
            "entdata" => $count
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME SEARCH
    |--------------------------------------------------------------------------
    */

    public function searchcat()
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // Search Query
        $search = \App\Models\ExpenseCategory::latest('excat_entry_date');

        if(request('searchcat')) {
            $search->where('excat_name', 'like', '%' . request('searchcat') . '%');
        }

        $historycat = request('searchcat');

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Expense",

            // Main table view
            "expenses" => Expense::latest('expense_entry_date')->get(),
            "categories" => $search->get(),
            
            // For showing data
            "dataopt" => \App\Models\ExpenseCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "excats"=> $dummies,
            "lists" => $dummies,
            "inviews" => $dummies,

            // History for search
            "historycat" => $historycat, 
            "historylist" =>null, 

            // For JavaScript show 
            "editcategoryjs" => 0,

            // For showing entries
            "entdata" => 0,
        ]);
    }

    public function searchlist()
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();
    
        // List Query Search
        $search = DB::table('expenses')
        ->select('expense_description', 'expense_categories.excat_name' ,'expense_nominal', 'expense_entry_date', 'expense_slug')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->where('expenses.expense_description','like', '%' . request('searchlist') . '%')
        ->orWhere('expenses.expense_entry_date','like', '%' . request('searchlist') . '%')
        ->orWhere('expense_categories.excat_name','like', '%' . request('searchlist') . '%') 
        ->get();

        if(request('searchlist')) {
            $search->where('expense_description', 'like', '%' . request('searchlist') . '%');
        }

        $historylist = request('searchlist');

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Expense",

            // Main table view
            "expenses" => $search,
            "categories" => \App\Models\ExpenseCategory::latest('excat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\ExpenseCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "excats"=> $dummies,
            "lists" => $dummies,
            "inviews" => $dummies,

            // History for search
            "historycat" => null, 
            "historylist" => $historylist, 

            // For JavaScript show
            "editcategoryjs" => 0,

            // For showing entries
            "entdata" => 0,

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME TO VIEW CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function viewcategory($excat_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();

        // View category
        $category = DB::table('expense_categories')->where('excat_slug',$excat_slug)->get();

        return view('/pages/expenses/expenses', [

           // Title 
           "title" => "Expense",

           // Main table view
           "expenses" => $expenses,
           "categories" => \App\Models\ExpenseCategory::latest('excat_entry_date')->get(),
           
           // For showing data
           "dataopt" => \App\Models\ExpenseCategory::latest('id')->get(),
           "accopt" => \App\Models\Account::latest('id')->get(),

           // Count entries
           "listcount" => $listcount,
           "catcount" => $catcount,

           // N+1
           "excats"=> $category,
           "lists" => $dummies,
           "inviews" => $dummies,

           // History for search
           "historycat" => null, 
           "historylist" =>null, 

           // For JavaScript show 
           "editcategoryjs" => 2,
            
            // For showing entries
            "entdata" => 0,
        ]);
    }

    public function viewlist($expense_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // Expense Order By Descendant
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();

        // View list query
        $inviews = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->where('expenses.expense_slug',$expense_slug)
        ->get();


        return view('/pages/expenses/expenses', [

           // Title 
           "title" => "Expense",

           // Main table view
           "expenses" => $expenses,
           "categories" => \App\Models\ExpenseCategory::latest('excat_entry_date')->get(),
           
           // For showing data
           "dataopt" => \App\Models\ExpenseCategory::latest('id')->get(),
           "accopt" => \App\Models\Account::latest('id')->get(),

           // Count entries
           "listcount" => $listcount,
           "catcount" => $catcount,

           // N+1
           "excats"=> $dummies,
           "lists" => $dummies,
           "inviews" => $inviews, 

           // History for search
           "historycat" => null, 
           "historylist" =>null, 

           // For JavaScript show
           "editcategoryjs" => 4,

            // For showing entries
            "entdata" => 0

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | INCOME TO CREATE NEW CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function addcategory(Request $request)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();


        // Query insert database
        DB::table('expense_categories')->insert([
            'excat_name'=>$request->excat_name,
            'excat_entry_date'=>$request->excat_date,
            'excat_slug'=>$request->excat_slug
        ]);

        return redirect('/expense');
    }


    public function addlist(Request $request)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();

        // Query insert Database
        DB::table('expenses')->insert([
            'expense_description'=>$request->input_decs,
            'expense_category_id' => $request->input_cats,
            'expense_account_id' => $request->input_acc,
            'expense_entry_date' => $request-> input_date,
            'expense_slug' => $request->expense_slug,
            'expense_nominal' => $request-> input_nominal
        ]);

        return redirect('/expense');
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */
    public function editcatlanding($excat_slug)
    {        
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for find landing category
        $category = DB::table('expense_categories')->where('excat_slug',$excat_slug)->get();

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Expense",

            // Main table view
            "expenses" => $expenses,
            "categories" => \App\Models\ExpenseCategory::latest('excat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\ExpenseCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
    
            // N+1
            "excats"=> $category,
            "lists" => $dummies,
            "inviews" => $dummies,
    
            // History for search
            "historycat" => null, 
            "historylist" =>null,
    
            // For JavaScript show 
            "editcategoryjs" => 1,
        
            // For showing entries
            "entdata" => 0,
        ]);
    }

    public function editstore($expense_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();
    
        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for find landing list
        $list = DB::table('expenses')->where('expense_slug',$expense_slug)->get();

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Expense",

            // Main table view
            "expenses" => $expenses,
            "categories" => \App\Models\ExpenseCategory::latest('excat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\ExpenseCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
            // "expense" => Expense::where('expense_entry_date', date("l, d-M-Y"))->get(),

            // N+1
            "excats"=> $dummies,
            "lists" => $list,
            "inviews" => $dummies,
    
            // History for search
            "historycat" => null, 
            "historylist" =>null,
    
            // For JavaScript show 
            "editcategoryjs" => 3,

            // For showing entries
            "entdata" => 0,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME TO UPDATE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function editcategory(Request $request, $excat_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for edit category
        DB::table('expense_categories')->where('excat_slug', $excat_slug)->update([
            'excat_name'=>$request->excat_name
		]);
        
        return redirect('/expense');
    }

    public function editlist(Request $request, $expense_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for edit list
        DB::table('expenses')->where('expense_slug', $expense_slug)->update([
            'expense_description'=>$request->input_decs,
            'expense_category_id' => $request->input_cats,
            'expense_account_id' => $request->input_acc,
            'expense_entry_date' => $request-> input_date,
            'expense_slug' => $request-> expense_slug,
            'expense_nominal' => $request-> input_nominal
		]);
        
        return redirect('/expense');
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME TO DELETE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function deletecatlanding($excat_slug)
    {        
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for find landing category
        $category = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->select('expenses.*', 'expense_categories.*')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->where('expense_categories.excat_slug',$excat_slug)
        ->get();

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Expense",

            // Main table view
            "expenses" => $expenses,
            "categories" => \App\Models\ExpenseCategory::latest('excat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\ExpenseCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
    
            // N+1
            "excats"=> $category,
            "lists" => $dummies,
            "inviews" => $dummies,
    
            // History for search
            "historycat" => null, 
            "historylist" =>null,
    
            // For JavaScript show 
            "editcategoryjs" => 5,
        
            // For showing entries
            "entdata" => 0,
        ]);
    }

    public function deletecategory(Request $request, $excat_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for delete category
        DB::table('expense_categories')->where('excat_slug',$excat_slug)->delete();

        return redirect('/expense');
    }

    public function deletelistlanding($expense_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();
    
        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for find landing list
        $list = DB::table('expenses')->where('expense_slug',$expense_slug)->get();

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Expense",

            // Main table view
            "expenses" => $expenses,
            "categories" => \App\Models\ExpenseCategory::latest('excat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\ExpenseCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
            // "expense" => Expense::where('expense_entry_date', date("l, d-M-Y"))->get(),

            // N+1
            "excats"=> $dummies,
            "lists" => $list,
            "inviews" => $dummies,
    
            // History for search
            "historycat" => null, 
            "historylist" =>null,
    
            // For JavaScript show 
            "editcategoryjs" => 6,

            // For showing entries
            "entdata" => 0,
        ]);
    }

    public function deletelist($expense_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // List order by date
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.excat_name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for delete list
        DB::table('expenses')->where('expense_slug',$expense_slug)->delete();        

        return redirect('/expense');
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME TO PRINT
    |--------------------------------------------------------------------------
    */

    public function printstore()
    {      
        $alldata = DB::table('expenses')
        ->select('expense_description', 'expense_categories.excat_name' ,'expense_nominal','expense_entry_date')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        // ->where('expense.expense_slug','expense_slug')
        ->get();
        
        return view('/pages/expenses/print', [
            // Title / Judul
            "title" => "Expense",

            // Redirect
            "bck" => "expense",

            // Listing number
            "number" => 1,

            // Total money
            "total" => 0,

            // All data ubcine
            "expenses" => Dump::latest()->get()
        ]);
    }

    public function printsearch(Request $request)
    {      
        $alldata = DB::table('expenses')
        ->select('expense_description', 'expense_categories.excat_name' ,'expense_nominal','expense_entry_date')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->whereBetween('expense_entry_date', [request('start'), request('end')])
        ->get();
        
        return view('/pages/expenses/print', [
            // Title / Judul
            "title" => "Expense",

            // Redirect
            "bck" => "expense",

            // Listing number
            "number" => 1,

            // Total money
            "total" => 0,

            // All data ubcine
            "expenses" => $alldata
        ]);
    }
}