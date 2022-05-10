<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// MODEL
use App\Models\Income;
use App\Models\IncomeCategory;

class IncomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INCOME MAIN PAGE
    |--------------------------------------------------------------------------
    */

    public function start()
    {
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),
            "lists" => Income::latest(),
            "inviews" => Income::latest()->get(),

        ]);
    }

        /*
    |--------------------------------------------------------------------------
    | INCOME TO VIEW CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function viewcategory($incat_slug)
    {
        $category = DB::table('income_categories')->where('incat_slug',$incat_slug)->get();

        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 2,
            "incats" => $category,
            "lists" => Income::latest(),
            "inviews" => Income::latest()->get(),
            
        ]);
    }

    public function viewlist($income_slug)
    {
        $inviews = DB::table('incomes')
        ->select('income_description', 'income_categories.name' ,'nominal')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->where('incomes.income_slug',$income_slug)
        ->get();


        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 4,
            "incats" => \App\Models\IncomeCategory::latest()->get(),
            "lists" => Income::latest(),
            "inviews" => $inview,
            // "tesasa" => $test
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | INCOME TO CREATE NEW CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function addcategory(Request $request)
    {
        DB::table('income_categories')->insert([
            'name'=>$request->incat_name,
            'incat_entry_date'=>$request->incat_date,
            'incat_slug'=>$request->incat_slug
        ]);
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "incomes" => Income::latest()->get(),
            "incats"=> Income::latest()->get(),
            "lists" => Income::latest(),
            "inviews" => Income::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,


        ]);
    }


    public function addlist(Request $request)
    {
        DB::table('incomes')->insert([
            'income_description'=>$request->input_decs,
            'income_category_id' => $request->input_cats,
            'income_entry_date' => $request-> input_date,
            'income_slug' => $request-> income_slug,
            'nominal' => $request-> input_nominal
        ]);
        
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "incomes" => Income::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),
            "lists" => Income::latest(),
            "inviews" => Income::latest()->get(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME UPDATE LANDING PAGE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */
    public function editcatlanding($incat_slug)
    {
        $category = DB::table('income_categories')->where('incat_slug',$incat_slug)->get();

        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 1,
            "incats" => $category,
            "inviews" => Income::latest()->get(),
            "lists" => Income::latest(),
            "update" => null
        ]);
    }

    public function editstore($income_slug)
    {
        $list = DB::table('incomes')->where('income_slug',$income_slug)->get();

        // $test = DB::table('incomes')
        // ->select('*', 'income_categories.name')
        // ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        // ->where('incomes.income_slug',$income_slug)
        // ->get();

        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
        "incomes" => Income::latest()->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 3,
            "incats" => \App\Models\IncomeCategory::latest()->get(),
            "inviews" => Income::latest()->get(),
            "update" => null,
            "lists" => $list
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME TO UPDATE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function editcategory(Request $request, $incat_slug)
    {
        DB::table('income_categories')->where('incat_slug', $incat_slug)->update([
            'name'=>$request->incat_name
		]);
        
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),
            "inviews" => Income::latest()->get(),
            "lists" => Income::latest(),
        ]);
    }

    public function editlist(Request $request, $income_slug)
    {
        DB::table('incomes')->where('income_slug', $income_slug)->update([
            'income_description'=>$request->input_decs,
            'income_category_id' => $request->input_cats,
            'income_entry_date' => $request-> input_date,
            'income_slug' => $request-> income_slug,
            'nominal' => $request-> input_nominal
		]);
        
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),
            "inviews" => Income::latest()->get(),
            "lists" => Income::latest(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME TO DELETE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function deletelist($income_slug)
    {
        DB::table('incomes')->where('income_slug',$income_slug)->delete();        

        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),
            "lists" => Income::latest(),
            "inviews" => Income::latest()->get(),

        ]);
    }

    public function deletecategory($incat_slug)
    {
        DB::table('income_categories')->where('incat_slug',$incat_slug)->delete();
        

        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),
            "lists" => Income::latest(),
            "inviews" => Income::latest()->get(),

        ]);
    }
}