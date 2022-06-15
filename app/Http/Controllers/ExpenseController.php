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
    | EXPENSE MAIN PAGE
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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();


        return view('/pages/expenses/expenses', [
            
            // Title 
            "title" => "Income",

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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();

        // RUMUS TAEK


        return view('/pages/expenses/expenses', [
            
            // Title 
            "title" => "Income",

            // Main table view
            "expenses" => $expenses, // Income::latest('expense_entry_date')->get(),
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
    | EXPENSE SEARCH
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
            $search->where('name', 'like', '%' . request('searchcat') . '%');
        }

        $historycat = request('searchcat');

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Income",

            // Main table view
            "expenses" => Income::latest('expense_entry_date')->get(),
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
        ->select('income_description', 'expense_categories.name' ,'nominal', 'expense_entry_date', 'income_slug')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->where('expenses.income_description','like', '%' . request('searchlist') . '%')
        ->orWhere('expenses.expense_entry_date','like', '%' . request('searchlist') . '%')
        ->orWhere('expense_categories.name','like', '%' . request('searchlist') . '%') 
        ->get();

        if(request('searchlist')) {
            $search->where('income_description', 'like', '%' . request('searchlist') . '%');
        }

        $historylist = request('searchlist');

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Income",

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
    | EXPENSE TO VIEW CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function viewcategory($incat_slug)
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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();

        // View category
        $category = DB::table('expense_categories')->where('incat_slug',$incat_slug)->get();

        return view('/pages/expenses/expenses', [

           // Title 
           "title" => "Income",

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

    public function viewlist($income_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('expenses')->count();
        $catcount = DB::table('expense_categories')->count();

        // Income Order By Descendant
        $expenses = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();

        // View list query
        $inviews = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->join('accounts', 'accounts.id', '=', 'expense_account_id')
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->where('expenses.income_slug',$income_slug)
        ->get();


        return view('/pages/expenses/expenses', [

           // Title 
           "title" => "Income",

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
    | EXPENSE TO CREATE NEW CATEGORY / LIST
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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();


        // Query insert database
        DB::table('expense_categories')->insert([
            'name'=>$request->incat_name,
            'excat_entry_date'=>$request->incat_date,
            'incat_slug'=>$request->incat_slug
        ]);

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Income",

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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();

        // Query insert Database
        DB::table('expenses')->insert([
            'income_description'=>$request->input_decs,
            'expense_category_id' => $request->input_cats,
            'expense_account_id' => $request->input_acc,
            'expense_entry_date' => $request-> input_date,
            'income_slug' => $request->income_slug,
            'nominal' => $request-> input_nominal
        ]);

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Income",

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

    /*
    |--------------------------------------------------------------------------
    | EXPENSE UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */
    public function editcatlanding($incat_slug)
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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for find landing category
        $category = DB::table('expense_categories')->where('incat_slug',$incat_slug)->get();

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Income",

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

    public function editstore($income_slug)
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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for find landing list
        $list = DB::table('expenses')->where('income_slug',$income_slug)->get();

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Income",

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
    | EXPENSE TO UPDATE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function editcategory(Request $request, $incat_slug)
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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for edit category
        DB::table('expense_categories')->where('incat_slug', $incat_slug)->update([
            'name'=>$request->incat_name
		]);
        
        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Income",

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

    public function editlist(Request $request, $income_slug)
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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for edit list
        DB::table('expenses')->where('income_slug', $income_slug)->update([
            'income_description'=>$request->input_decs,
            'expense_category_id' => $request->input_cats,
            'expense_account_id' => $request->input_acc,
            'expense_entry_date' => $request-> input_date,
            'income_slug' => $request-> income_slug,
            'nominal' => $request-> input_nominal
		]);
        
        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Income",

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

    /*
    |--------------------------------------------------------------------------
    | EXPENSE TO DELETE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function deletecatlanding($incat_slug)
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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for find landing category
        $category = DB::table('expenses')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->select('expenses.*', 'expense_categories.*')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->where('expense_categories.incat_slug',$incat_slug)
        ->get();

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Income",

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

    public function deletecategory(Request $request, $incat_slug)
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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
            // Query for delete category
            DB::table('expense_categories')->where('incat_slug',$incat_slug)->delete();

            // Query for delete category and tables
            // DB::table('expenses')->where('expense_category_id', request('destroy'))->delete();    

        return view('/pages/expenses/expenses', [
            
            // Title 
            "title" => "Income",

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

    public function deletelistlanding($income_slug)
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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for find landing list
        $list = DB::table('expenses')->where('income_slug',$income_slug)->get();

        return view('/pages/expenses/expenses', [

            // Title 
            "title" => "Income",

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

    public function deletelist($income_slug)
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
        ->select('expenses.*', 'expense_categories.name', 'accounts.account_name')
        ->orderBy('expenses.expense_entry_date','DESC')
        ->get();
        
        // Query for delete list
        DB::table('expenses')->where('income_slug',$income_slug)->delete();        

        return view('/pages/expenses/expenses', [
            
            // Title 
            "title" => "Income",

            // Main table view
            "expenses" => Income::latest('expense_entry_date')->get(),
            "categories" => \App\Models\ExpenseCategory::latest('excat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\ExpenseCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count Entries
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

    /*
    |--------------------------------------------------------------------------
    | EXPENSE TO PRINT
    |--------------------------------------------------------------------------
    */

    public function printstore()
    {      
        $alldata = DB::table('expenses')
        ->select('income_description', 'expense_categories.name' ,'nominal','expense_entry_date')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        // ->where('income.income_slug','income_slug')
        ->get();
        
        return view('/pages/expenses/print', [
            "title" => "Income",
            "bck" => "income",
            "number" => 1,
            "total" => 0,
            "expenses" => $alldata
        ]);
    }
}