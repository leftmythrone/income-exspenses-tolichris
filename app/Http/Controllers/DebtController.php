<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// MODEL
use App\Models\Debt;
use App\Models\DebtCategory;

class DebtController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | DEBT MAIN PAGE
    |--------------------------------------------------------------------------
    */

    public function start()
    {
        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 0,
            "debcats"=> Debt::latest()->get(),
            "lists" => Debt::latest(),
            "inviews" => Debt::latest()->get(),
            "historycat" => null,
            "historylist" =>null,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DEBT SEARCH
    |--------------------------------------------------------------------------
    */

    public function searchcat(Request $request)
    {
        $search = \App\Models\DebtCategory::latest();

        if(request('searchcat')) {
            $search->where('name', 'like', '%' . request('searchcat') . '%');
        }

        $historycat = request('searchcat');

        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            // "debts" => Debt::where('income_entry_date', date("l, d-M-Y"))->get(),
            // "categories" => \App\Models\DebtCategory::latest()->get(),
            "categories" => $search->get(),
            // "categories" => \App\Models\DebtCategory::where('incat_entry_date', date("l, d-M-Y"))->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 0,
            "debcats"=> Debt::latest()->get(),
            "lists" => Debt::latest(),
            // "lists" => Debt::where('income_entry_date', date("l, d-M-Y"))->get(),
            "inviews" => Debt::latest()->get(),
            "historycat" => $historycat,
            "historylist" =>null,

        ]);
    }

    public function searchlist()
    {
        $search = \App\Models\Debt::latest();

        if(request('searchlist')) {
            $search->where('debt_description', 'like', '%' . request('searchlist') . '%');
        }

        $historylist = request('searchlist');

        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => $search->get(),
            // "debts" => Debt::where('income_entry_date', date("l, d-M-Y"))->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            // "categories" => \App\Models\DebtCategory::where('incat_entry_date', date("l, d-M-Y"))->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 0,
            "debcats"=> Debt::latest()->get(),
            "lists" => Debt::latest(),
            // "lists" => Debt::where('income_entry_date', date("l, d-M-Y"))->get(),
            "inviews" => Debt::latest()->get(),
            "historycat" =>null,
            "historylist" => $historylist,

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DEBT TO VIEW CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function viewcategory($debcat_slug)
    {
        $category = DB::table('debt_categories')->where('debcat_slug',$debcat_slug)->get();

        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 2,
            "debcats" => $category,
            "lists" => Debt::latest(),
            "inviews" => Debt::latest()->get(),
                                    "historycat" => null,
            "historylist" =>null,
            
        ]);
    }

    public function viewlist($debt_slug)
    {
        $inview = DB::table('debts')
        ->select('debt_description', 'debt_categories.name' ,'nominal')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->where('debts.debt_slug',$debt_slug)
        ->get();


        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 4,
            "debcats" => \App\Models\DebtCategory::latest()->get(),
            "lists" => Debt::latest(),
            "inviews" => $inview,
                                    "historycat" => null,
            "historylist" =>null,
            // "tesasa" => $test
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | DEBT TO CREATE NEW CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function addcategory(Request $request)
    {
        DB::table('debt_categories')->insert([
            'name'=>$request->debcat_name,
            'debcat_entry_date'=>$request->debcat_date,
            'debcat_slug'=>$request->debcat_slug
        ]);
        return view('/pages/debts/debts', [
            "title" => "Debt",
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "debts" => Debt::latest()->get(),
            "debcats"=> Debt::latest()->get(),
            "lists" => Debt::latest(),
            "inviews" => Debt::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 0,
                                    "historycat" => null,
            "historylist" =>null,


        ]);
    }


    public function addlist(Request $request)
    {
        DB::table('debts')->insert([
            'debt_description'=>$request->input_decs,
            'debt_category_id' => $request->input_cats,
            'debt_entry_date' => $request-> input_date,
            'debt_slug' => $request-> debt_slug,
            'nominal' => $request-> input_nominal
        ]);
        
        return view('/pages/debts/debts', [
            "title" => "Debt",
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "debts" => Debt::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 0,
            "debcats"=> Debt::latest()->get(),
            "lists" => Debt::latest(),
            "inviews" => Debt::latest()->get(),
                                    "historycat" => null,
            "historylist" =>null,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DEBT UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */
    public function editcatlanding($debcat_slug)
    {
        $category = DB::table('debt_categories')->where('debcat_slug',$debcat_slug)->get();

        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 1,
            "debcats" => $category,
            "inviews" => Debt::latest()->get(),
            "lists" => Debt::latest(),
                                    "historycat" => null,
            "historylist" =>null,
            "update" => null
        ]);
    }

    public function editstore($debt_slug)
    {
        $list = DB::table('debts')->where('debt_slug',$debt_slug)->get();

        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 3,
            "debcats" => \App\Models\DebtCategory::latest()->get(),
            "inviews" => Debt::latest()->get(),
            "update" => null,
                                    "historycat" => null,
            "historylist" =>null,
            "lists" => $list
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DEBT TO UPDATE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function editcategory(Request $request, $debcat_slug)
    {
        DB::table('debt_categories')->where('debcat_slug', $debcat_slug)->update([
            'name'=>$request->debcat_name
		]);
        
        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 0,
            "debcats"=> Debt::latest()->get(),
            "inviews" => Debt::latest()->get(),
            "lists" => Debt::latest(),
                                    "historycat" => null,
            "historylist" =>null,
        ]);
    }

    public function editlist(Request $request, $debt_slug)
    {
        DB::table('debts')->where('debt_slug', $debt_slug)->update([
            'debt_description'=>$request->input_decs,
            'debt_category_id' => $request->input_cats,
            'debt_entry_date' => $request-> input_date,
            'debt_slug' => $request-> debt_slug,
            'nominal' => $request-> input_nominal
		]);
        
        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 0,
            "debcats"=> Debt::latest()->get(),
            "inviews" => Debt::latest()->get(),
            "lists" => Debt::latest(),
                                    "historycat" => null,
            "historylist" =>null,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DEBT TO DELETE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function deletelist($debt_slug)
    {
        DB::table('debts')->where('debt_slug',$debt_slug)->delete();        

        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 0,
            "debcats"=> Debt::latest()->get(),
            "lists" => Debt::latest(),
            "inviews" => Debt::latest()->get(),
                                    "historycat" => null,
            "historylist" =>null,

        ]);
    }

    public function deletecategory($debcat_slug)
    {
        DB::table('debt_categories')->where('debcat_slug',$debcat_slug)->delete();
        

        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 0,
            "debcats"=> Debt::latest()->get(),
            "lists" => Debt::latest(),
            "inviews" => Debt::latest()->get(),
                                    "historycat" => null,
            "historylist" =>null,

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DEBT TO DELETE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function debtlanding($debt_slug)
    {
        DB::table('debts')->where('debt_slug',$debt_slug)->delete();        

        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 0,
            "debcats"=> Debt::latest()->get(),
            "lists" => Debt::latest(),
            "inviews" => Debt::latest()->get(),
                                    "historycat" => null,
            "historylist" =>null,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | DEBT TO DELETE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function paidlanding($debt_slug)
    {
        $list = DB::table('debts')->where('debt_slug',$debt_slug)->get();

        return view('/pages/debts/debts', [
            "title" => "Debt",
            "sidebars" => "partials.sidebar",
            "debts" => Debt::latest()->get(),
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 5,
            "debcats" => \App\Models\DebtCategory::latest()->get(),
            "inviews" => Debt::latest()->get(),
            "update" => null,
            "historycat" => null,
            "historylist" =>null,
            "lists" => $list
        ]);
    }


    // HERE TO CONVERT
    public function paiddebt(Request $request, $debt_slug)
    {
        DB::table('debts')->insert([
            'income_description'=>$request->input_decs,
            'income_category_id' => $request->input_cats,
            'income_entry_date' => $request-> input_date,
            'income_slug' => $request-> income_slug,
            'nominal' => $request-> input_nominal
        ]);

        DB::table('debts')->where('debt_slug',$debt_slug)->delete();        

        
        return view('/pages/debts/debts', [
            "title" => "Debt",
            "categories" => \App\Models\DebtCategory::latest()->get(),
            "debts" => Debt::latest()->get(),
            "dataopt" => \App\Models\DebtCategory::latest()->get(),
            "editcategoryjs" => 0,
            "debcats"=> Debt::latest()->get(),
            "lists" => Debt::latest(),
            "inviews" => Debt::latest()->get(),
                                    "historycat" => null,
            "historylist" =>null,
        ]);
    }



    /*
    |--------------------------------------------------------------------------
    | DEBT TO PRINT
    |--------------------------------------------------------------------------
    */

    public function printstore()
    {      
        $alldata = DB::table('debts')
        ->select('debt_description', 'debt_categories.name' ,'nominal','debt_entry_date')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        // ->where('debts.income_slug','income_slug')
        ->get();
        
        return view('/pages/debts/print', [
            "title" => "Debt",
            "bck" => "debt",
            "number" => 1,
            "total" => 0,
            "debts" => $alldata
        ]);
    }
}