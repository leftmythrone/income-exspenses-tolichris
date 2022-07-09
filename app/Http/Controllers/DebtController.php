<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// MODEL
use App\Models\Account;
use App\Models\Debt;
use App\Models\DebtCategory;
use App\Models\Dump;

class DebtController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DEBT MAIN PAGE
    |--------------------------------------------------------------------------
    */

    public function start()
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();

        return view('/pages/debts/debts', [
            
            // Title 
            "title" => "Debt",

            // Main table view
            "debts" => $debts,
            "categories" => \App\Models\DebtCategory::latest('debcat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\DebtCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "debcats"=> $dummies,
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
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();

        // RUMUS TAEK


        return view('/pages/debts/debts', [
            
            // Title 
            "title" => "Debt",

            // Main table view
            "debts" => $debts, // Debt::latest('debt_entry_date')->get(),
            "categories" => \App\Models\DebtCategory::latest('debcat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\DebtCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "debcats"=> $dummies,
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
    | DEBT SEARCH
    |--------------------------------------------------------------------------
    */

    public function searchcat()
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // Search Query
        $search = \App\Models\DebtCategory::latest('debcat_entry_date');

        if(request('searchcat')) {
            $search->where('debcat_name', 'like', '%' . request('searchcat') . '%');
        }

        $historycat = request('searchcat');

        return view('/pages/debts/debts', [

            // Title 
            "title" => "Debt",

            // Main table view
            "debts" => Debt::latest('debt_entry_date')->get(),
            "categories" => $search->get(),
            
            // For showing data
            "dataopt" => \App\Models\DebtCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "debcats"=> $dummies,
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
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();
    
        // List Query Search
        $search = DB::table('debts')
        ->select('debt_description', 'debt_categories.debcat_name' ,'debt_nominal', 'debt_entry_date', 'debt_slug')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->orderBy('debts.debt_entry_date','DESC')
        ->where('debts.debt_description','like', '%' . request('searchlist') . '%')
        ->orWhere('debts.debt_entry_date','like', '%' . request('searchlist') . '%')
        ->orWhere('debt_categories.debcat_name','like', '%' . request('searchlist') . '%') 
        ->get();

        if(request('searchlist')) {
            $search->where('debt_description', 'like', '%' . request('searchlist') . '%');
        }

        $historylist = request('searchlist');

        return view('/pages/debts/debts', [

            // Title 
            "title" => "Debt",

            // Main table view
            "debts" => $search,
            "categories" => \App\Models\DebtCategory::latest('debcat_entry_date')->get(),
            
            // For showing data
            "dataopt" => \App\Models\DebtCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),

            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,

            // N+1
            "debcats"=> $dummies,
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
    | DEBT TO VIEW CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function viewcategory($debcat_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();

        // View category
        $category = DB::table('debt_categories')->where('debcat_slug',$debcat_slug)->get();

        return view('/pages/debts/debts', [

           // Title 
           "title" => "Debt",

           // Main table view
           "debts" => $debts,
           "categories" => \App\Models\DebtCategory::latest('debcat_entry_date')->get(),
           
           // For showing data
           "dataopt" => \App\Models\DebtCategory::latest('id')->get(),
           "accopt" => \App\Models\Account::latest('id')->get(),

           // Count entries
           "listcount" => $listcount,
           "catcount" => $catcount,

           // N+1
           "debcats"=> $category,
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

    public function viewlist($debt_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // Debt Order By Descendant
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();

        // View list query
        $inviews = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->where('debts.debt_slug',$debt_slug)
        ->get();


        return view('/pages/debts/debts', [

           // Title 
           "title" => "Debt",

           // Main table view
           "debts" => $debts,
           "categories" => \App\Models\DebtCategory::latest('debcat_entry_date')->get(),
           
           // For showing data
           "dataopt" => \App\Models\DebtCategory::latest('id')->get(),
           "accopt" => \App\Models\Account::latest('id')->get(),

           // Count entries
           "listcount" => $listcount,
           "catcount" => $catcount,

           // N+1
           "debcats"=> $dummies,
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
    | DEBT TO CREATE NEW CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function addcategory(Request $request)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();


        // Query insert database
        DB::table('debt_categories')->insert([
            'debcat_name'=>$request->debcat_name,
            'debcat_entry_date'=>$request->debcat_date,
            'debcat_slug'=>$request->debcat_slug
        ]);

        return redirect('/debt');
    }


    public function addlist(Request $request)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();

        // Query insert Database
        DB::table('debts')->insert([
            'debt_description'=>$request->input_decs,
            'debt_category_id' => $request->input_cats,
            'debt_account_id' => $request->input_acc,
            'debt_entry_date' => $request-> input_date,
            'debt_slug' => $request->debt_slug,
            'debt_nominal' => $request-> input_nominal
        ]);

        return redirect('/debt');
    }

    /*
    |--------------------------------------------------------------------------
    | DEBT UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */
    public function editcatlanding($debcat_slug)
    {        
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();
        
        // Query for find landing category
        $category = DB::table('debt_categories')->where('debcat_slug',$debcat_slug)->get();

        return view('/pages/debts/debts', [

            // Title 
            "title" => "Debt",

            // Main table view
            "debts" => $debts,
            "categories" => \App\Models\DebtCategory::latest('debcat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\DebtCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
    
            // N+1
            "debcats"=> $category,
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

    public function editstore($debt_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();
    
        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();
        
        // Query for find landing list
        $list = DB::table('debts')->where('debt_slug',$debt_slug)->get();

        return view('/pages/debts/debts', [

            // Title 
            "title" => "Debt",

            // Main table view
            "debts" => $debts,
            "categories" => \App\Models\DebtCategory::latest('debcat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\DebtCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
            // "expense" => Expense::where('debt_entry_date', date("l, d-M-Y"))->get(),

            // N+1
            "debcats"=> $dummies,
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
    | DEBT TO UPDATE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function editcategory(Request $request, $debcat_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();
        
        // Query for edit category
        DB::table('debt_categories')->where('debcat_slug', $debcat_slug)->update([
            'debcat_name'=>$request->debcat_name
		]);
        
        return redirect('/debt');

    }

    public function editlist(Request $request, $debt_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();
        
        // Query for edit list
        DB::table('debts')->where('debt_slug', $debt_slug)->update([
            'debt_description'=>$request->input_decs,
            'debt_category_id' => $request->input_cats,
            'debt_account_id' => $request->input_acc,
            'debt_entry_date' => $request-> input_date,
            'debt_slug' => $request-> debt_slug,
            'debt_nominal' => $request-> input_nominal
		]);
        
        return redirect('/debt');

    }

    /*
    |--------------------------------------------------------------------------
    | DEBT TO DELETE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function deletecatlanding($debcat_slug)
    {        
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();
        
        // Query for find landing category
        $category = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->select('debts.*', 'debt_categories.*')
        ->orderBy('debts.debt_entry_date','DESC')
        ->where('debt_categories.debcat_slug',$debcat_slug)
        ->get();

        return view('/pages/debts/debts', [

            // Title 
            "title" => "Debt",

            // Main table view
            "debts" => $debts,
            "categories" => \App\Models\DebtCategory::latest('debcat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\DebtCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
    
            // N+1
            "debcats"=> $category,
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

    public function deletecategory(Request $request, $debcat_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();
        
        // Query for delete category
        DB::table('debt_categories')->where('debcat_slug',$debcat_slug)->delete();

        return redirect('/debt');

    }

    public function deletelistlanding($debt_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();
    
        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();
        
        // Query for find landing list
        $list = DB::table('debts')->where('debt_slug',$debt_slug)->get();

        return view('/pages/debts/debts', [

            // Title 
            "title" => "Debt",

            // Main table view
            "debts" => $debts,
            "categories" => \App\Models\DebtCategory::latest('debcat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\DebtCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
            // "expense" => Expense::where('debt_entry_date', date("l, d-M-Y"))->get(),

            // N+1
            "debcats"=> $dummies,
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

    public function deletelist($debt_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();
        
        // Query for delete list
        DB::table('debts')->where('debt_slug',$debt_slug)->delete();        

        return redirect('/debt');

    }

    /*
    |--------------------------------------------------------------------------
    | DEBT TO CONVERT TO INCOME
    |--------------------------------------------------------------------------
    */


    public function paidlanding($debt_slug)
    {

        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();
    
        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();
        
        // Query for find landing list
        $list = DB::table('debts')->where('debt_slug',$debt_slug)->get();

        return view('/pages/debts/debts', [

            // Title 
            "title" => "Debt",

            // Main table view
            "debts" => $debts,
            "categories" => \App\Models\DebtCategory::latest('debcat_entry_date')->get(),
                
            // For showing data
            "dataopt" => \App\Models\DebtCategory::latest('id')->get(),
            "accopt" => \App\Models\Account::latest('id')->get(),
    
            // Count entries
            "listcount" => $listcount,
            "catcount" => $catcount,
            // "expense" => Expense::where('debt_entry_date', date("l, d-M-Y"))->get(),

            // N+1
            "debcats"=> $dummies,
            "lists" => $list,
            "inviews" => $dummies,
    
            // History for search
            "historycat" => null, 
            "historylist" =>null,
    
            // For JavaScript show 
            "editcategoryjs" => 7,

            // For showing entries
            "entdata" => 0,

        ]);
    }


    // HERE TO CONVERT
    public function paiddebt(Request $request, $debt_slug)
    {
        // N+1 Query
        $dummies = Dump::first()->get();

        // Counting query
        $listcount = DB::table('debts')->count();
        $catcount = DB::table('debt_categories')->count();

        // List order by date
        $debts = DB::table('debts')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->join('accounts', 'accounts.id', '=', 'debt_account_id')
        ->select('debts.*', 'debt_categories.debcat_name', 'accounts.account_name')
        ->orderBy('debts.debt_entry_date','DESC')
        ->get();

        DB::table('incomes')->insert([
            'income_description'=>$request->input_decs,
            'income_category_id' => $request->input_cats,
            'income_account_id' => $request->input_acc,
            'income_entry_date' => $request-> input_date,
            'income_slug' => $request-> debt_slug,
            'income_nominal' => $request-> input_nominal
		]);

        DB::table('debts')->where('debt_slug',$debt_slug)->delete();        
        
        return redirect('/debt');
    }

    /*
    |--------------------------------------------------------------------------
    | DEBT TO PRINT
    |--------------------------------------------------------------------------
    */

    public function printstore()
    {      
        $alldata = DB::table('debts')
        ->select('debt_description', 'debt_categories.debcat_name' ,'debt_nominal','debt_entry_date')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        // ->where('debt.debt_slug','debt_slug')
        ->get();
        
        return view('/pages/debts/print', [
            // Title / Judul
            "title" => "Debt",

            // Redirect
            "bck" => "debt",

            // Listing number
            "number" => 1,

            // Total money
            "total" => 0,

            // All data ubcine
            "debts" => Dump::latest()->get()
        ]);
    }

    public function printsearch(Request $request)
    {      
        $alldata = DB::table('debts')
        ->select('debt_description', 'debt_categories.debcat_name' ,'debt_nominal','debt_entry_date')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->whereBetween('debt_entry_date', [request('start'), request('end')])
        ->get();
        
        return view('/pages/debts/print', [
            // Title / Judul
            "title" => "Debt",

            // Redirect
            "bck" => "debt",

            // Listing number
            "number" => 1,

            // Total money
            "total" => 0,

            // All data ubcine
            "debts" => $alldata
        ]);
    }
}