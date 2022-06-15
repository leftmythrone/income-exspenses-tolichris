<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// MODEL
use App\Models\Account;
use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\Dump;

class IncomeController extends Controller
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();


        return view('/pages/incomes/incomes', [
            
            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $incomes,
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "incats"=> $dummies,
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();

        // RUMUS TAEK


        return view('/pages/incomes/incomes', [
            
            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $incomes, // Income::latest('income_entry_date')->get(),
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "incats"=> $dummies,
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // Search Query
        $search = \App\Models\IncomeCategory::latest('incat_entry_date');

        if(request('searchcat')) {
            $search->where('name', 'like', '%' . request('searchcat') . '%');
        }

        $historycat = request('searchcat');

        return view('/pages/incomes/incomes', [

            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => Income::latest('income_entry_date')->get(),
            "categories" => $search->get(),
            
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "incats"=> $dummies,
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();
    
        // List Query Search
        $search = DB::table('incomes')
        ->select('income_description', 'income_categories.name' ,'nominal', 'income_entry_date', 'income_slug')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->orderBy('incomes.income_entry_date','DESC')
        ->where('incomes.income_description','like', '%' . request('searchlist') . '%')
        ->orWhere('incomes.income_entry_date','like', '%' . request('searchlist') . '%')
        ->orWhere('income_categories.name','like', '%' . request('searchlist') . '%') 
        ->get();

        if(request('searchlist')) {
            $search->where('income_description', 'like', '%' . request('searchlist') . '%');
        }

        $historylist = request('searchlist');

        return view('/pages/incomes/incomes', [

            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $search,
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "incats"=> $dummies,
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

    public function viewcategory($incat_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();

        // View category
        $category = DB::table('income_categories')->where('incat_slug',$incat_slug)->get();

        return view('/pages/incomes/incomes', [

           // Title 
           "title" => "Income",

           // Main table view
           "incomes" => $incomes,
           "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
           
           // For showing data
           "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
           "accopt" => \App\Models\Account::latest('id')->get(),

           // Count entries
           "listcount" => $listcount,
           "catcount" => $catcount,

           // N+1
           "incats"=> $category,
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // Income Order By Descendant
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();

        // View list query
        $inviews = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->where('incomes.income_slug',$income_slug)
        ->get();


        return view('/pages/incomes/incomes', [

           // Title 
           "title" => "Income",

           // Main table view
           "incomes" => $incomes,
           "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
           
           // For showing data
           "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
           "accopt" => \App\Models\Account::latest('id')->get(),

           // Count entries
           "listcount" => $listcount,
           "catcount" => $catcount,

           // N+1
           "incats"=> $dummies,
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();


        // Query insert database
        DB::table('income_categories')->insert([
            'name'=>$request->incat_name,
            'incat_entry_date'=>$request->incat_date,
            'incat_slug'=>$request->incat_slug
        ]);

        return view('/pages/incomes/incomes', [

            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $incomes,
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
    
            // N+1
            "incats"=> $dummies,
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();

        // Query insert Database
        DB::table('incomes')->insert([
            'income_description'=>$request->input_decs,
            'income_category_id' => $request->input_cats,
            'income_account_id' => $request->input_acc,
            'income_entry_date' => $request-> input_date,
            'income_slug' => $request->income_slug,
            'nominal' => $request-> input_nominal
        ]);

        return view('/pages/incomes/incomes', [

            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $incomes,
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
    
            // N+1
            "incats"=> $dummies,
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
    | INCOME UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */
    public function editcatlanding($incat_slug)
    {        
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();
        
        // Query for find landing category
        $category = DB::table('income_categories')->where('incat_slug',$incat_slug)->get();

        return view('/pages/incomes/incomes', [

            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $incomes,
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
    
            // N+1
            "incats"=> $category,
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();
    
        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();
        
        // Query for find landing list
        $list = DB::table('incomes')->where('income_slug',$income_slug)->get();

        return view('/pages/incomes/incomes', [

            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $incomes,
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
            // "expense" => Expense::where('income_entry_date', date("l, d-M-Y"))->get(),

            // N+1
            "incats"=> $dummies,
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

    public function editcategory(Request $request, $incat_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();
        
        // Query for edit category
        DB::table('income_categories')->where('incat_slug', $incat_slug)->update([
            'name'=>$request->incat_name
		]);
        
        return view('/pages/incomes/incomes', [

            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $incomes,
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "incats"=> $dummies,
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();
        
        // Query for edit list
        DB::table('incomes')->where('income_slug', $income_slug)->update([
            'income_description'=>$request->input_decs,
            'income_category_id' => $request->input_cats,
            'income_account_id' => $request->input_acc,
            'income_entry_date' => $request-> input_date,
            'income_slug' => $request-> income_slug,
            'nominal' => $request-> input_nominal
		]);
        
        return view('/pages/incomes/incomes', [

            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $incomes,
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "incats"=> $dummies,
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
    | INCOME TO DELETE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function deletecatlanding($incat_slug)
    {        
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();
        
        // Query for find landing category
        $category = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->select('incomes.*', 'income_categories.*')
        ->orderBy('incomes.income_entry_date','DESC')
        ->where('income_categories.incat_slug',$incat_slug)
        ->get();

        return view('/pages/incomes/incomes', [

            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $incomes,
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
    
            // N+1
            "incats"=> $category,
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();
        
            // Query for delete category
            DB::table('income_categories')->where('incat_slug',$incat_slug)->delete();

            // Query for delete category and tables
            // DB::table('incomes')->where('income_category_id', request('destroy'))->delete();    

        return view('/pages/incomes/incomes', [
            
            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $incomes,
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "incats"=> $dummies,
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();
    
        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();
        
        // Query for find landing list
        $list = DB::table('incomes')->where('income_slug',$income_slug)->get();

        return view('/pages/incomes/incomes', [

            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => $incomes,
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
            // "expense" => Expense::where('income_entry_date', date("l, d-M-Y"))->get(),

            // N+1
            "incats"=> $dummies,
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
        $listcount = DB::table('incomes')->count();
        $catcount = DB::table('income_categories')->count();

        // List order by date
        $incomes = DB::table('incomes')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->join('accounts', 'accounts.id', '=', 'income_account_id')
        ->select('incomes.*', 'income_categories.name', 'accounts.account_name')
        ->orderBy('incomes.income_entry_date','DESC')
        ->get();
        
        // Query for delete list
        DB::table('incomes')->where('income_slug',$income_slug)->delete();        

        return view('/pages/incomes/incomes', [
            
            // Title 
            "title" => "Income",

            // Main table view
            "incomes" => Income::latest('income_entry_date')->get(),
            "categories" => \App\Models\IncomeCategory::latest('incat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\IncomeCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count Entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "incats"=> $dummies,
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
    | INCOME TO PRINT
    |--------------------------------------------------------------------------
    */

    public function printstore()
    {      
        $alldata = DB::table('incomes')
        ->select('income_description', 'income_categories.name' ,'nominal','income_entry_date')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        // ->where('income.income_slug','income_slug')
        ->get();
        
        return view('/pages/incomes/print', [
            // Title / Judul
            "title" => "Income",

            // Redirect
            "bck" => "income",

            // Listing number
            "number" => 1,

            // Total money
            "total" => 0,

            // All data ubcine
            "incomes" => $alldata
        ]);
    }

    public function printsearch(Request $request)
    {      
        $alldata = DB::table('incomes')
        ->select('income_description', 'income_categories.name' ,'nominal','income_entry_date')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->whereBetween('income_entry_date', [request('start'), request('end')])
        ->get();
        
        return view('/pages/incomes/print', [
            // Title / Judul
            "title" => "Income",

            // Redirect
            "bck" => "income",

            // Listing number
            "number" => 1,

            // Total money
            "total" => 0,

            // All data ubcine
            "incomes" => $alldata
        ]);
    }
}