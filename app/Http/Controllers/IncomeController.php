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
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),
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
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),

        ]);
    }


    public function addnew(Request $request)
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
            // TO MAKE JS POP UP
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),
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
            "update" => null
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INCOME TO UPDATE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function editcategory(Request $request, $incat_slug)
    {
        DB::table('income_categories')->where('incat_slug',$request->incat_slug)->update([
            'name'=>$request->incat_name
		]);
        
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),
        ]);
    }

    public function update(Request $request)
	{
		// update data pegawai
		DB::table('pegawai')->where('id_pegawai',$request->id)->update([
			'nama_pegawai' => $request->nama,
			'jabatan_pegawai' => $request->jabatan,
			'umur_pegawai' => $request->umur,
			'alamat_pegawai' => $request->alamat
		]);
		// alihkan halaman ke halaman pegawai
		return redirect('/pegawai');
	}
    

    // public function update(Request $request)
    // {

    //     DB::table('pegawai')->where('id_pegawai',$request->id)->update([
	// 		'nama_pegawai' => $request->nama,
	// 		'jabatan_pegawai' => $request->jabatan,
	// 		'umur_pegawai' => $request->umur,
	// 		'alamat_pegawai' => $request->alamat
	// 	]);
    //     return view('/pages/incomes/incomes', [
    //         "title" => "Income",
    //         "sidebars" => "partials.sidebar",
    //         "incomes" => Income::latest()->get(),
    //         // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
    //         "categories" => \App\Models\IncomeCategory::latest()->get(),
    //         "dataopt" => \App\Models\IncomeCategory::latest()->get(),
    //         "incats"=> Income::latest()->get(),
    //     ]);
    // }

    /*
    |--------------------------------------------------------------------------
    | INCOME TO DELETE CATEGORY / LIST
    |--------------------------------------------------------------------------
    */

    public function deleteincome($income_slug)
    {
        DB::table('incomes')->where('income_slug',$income_slug)->delete();
		// alihkan halaman ke halaman pegawai
        

        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),

        ]);
    }

    public function deletecategory($incat_slug)
    {
        DB::table('income_categories')->where('incat_slug',$incat_slug)->delete();
        
        
		// alihkan halaman ke halaman pegawai

        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "dataopt" => \App\Models\IncomeCategory::latest()->get(),
            "editcategoryjs" => 0,
            "incats"=> Income::latest()->get(),

        ]);
    }
}