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
    | SOURCE OF INCOMES
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    public function start()
    {
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "number" => 1,
            "subtotal" => 0,
            "total" => 0
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SOURCE OF INCOMES
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    public function addnew(Request $request, )
    {

        DB::table('incomes')->insert([
            'income_description'=>$request->input_decs,
            'income_category_id' => $request->input_cats,
            'income_type_id' =>  $request-> input_type,
            'income_entry_date' => $request-> input_date,
            'income_token' => $request-> token,
            'nominal' => $request-> input_nominal
        ]);
        
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "incomes" => Income::latest()->get(),
            "number" => 0,
            "subtotal" => 0,
            "total" => 0

        ]);
    }

    public function sewahitung(Request $xx, $id)
    {
        $price=$xx->input('price');
        $durasi=$xx->input('durasi');
    	$quantity=$xx->input('quantity');
        $charge=$xx->input('charge');
        $diskon=$xx->input('diskon');
        
        $datatotal = new Katalog();
        $printtotal = $datatotal->sewasubtotal($price, $quantity, $durasi, $charge, $diskon);
        
        $datatotal2 = new Katalog();
        $bfore_charge = $datatotal2->nomcharge($price, $quantity, $durasi, $charge, $diskon);

        DB::table('histories')->insert([
            'durasi' => $xx->his_durasi,
            'harga_normal' => $xx->harga_normal,
            'nominal_charge' => $xx->bef_charge,
            'setelah_charge' => $xx->aft_charge,
		]);

        return view('page/sewa', [
            "title" => "Detail",
            "katalog" => Katalog::find($id),
            "bf_durasi" => $durasi,
            "bf_total" => $bfore_charge,
            // "diskons" => Diskon::all(),
            "subtotal" => 0,
            "total" => $printtotal
        ]);
    }

    public function addcategory(Request $request)
    {

        DB::table('income_categories')->insert([
            'name'=>$request->incat_name,
            'incat_entry_date'=>$request->incat_date,
            'incat_entry_token'=>$request->token
        ]);
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "incomes" => Income::latest()->get(),
            "number" => 1,
            "subtotal" => 0,
            "total" => 0

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SOURCE OF INCOMES
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    public function update(Request $request)
    {

        DB::table('pegawai')->where('id_pegawai',$request->id)->update([
			'nama_pegawai' => $request->nama,
			'jabatan_pegawai' => $request->jabatan,
			'umur_pegawai' => $request->umur,
			'alamat_pegawai' => $request->alamat
		]);
        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "number" => 1,
            "subtotal" => 0,
            "total" => 0
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SOURCE OF DELETE
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    public function deleteincome($income_token)
    {
        DB::table('incomes')->where('income_token',$income_token)->delete();
		// alihkan halaman ke halaman pegawai

        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "number" => 1,
            "subtotal" => 0,
            "total" => 0
        ]);
    }

    public function deletecategory($incat_entry_token)
    {
        DB::table('income_categories')->where('incat_entry_token',$incat_entry_token)->delete();
		// alihkan halaman ke halaman pegawai

        return view('/pages/incomes/incomes', [
            "title" => "Income",
            "sidebars" => "partials.sidebar",
            "incomes" => Income::latest()->get(),
            // "incomes" => Income::where('nominal', 'LIKE', '%1817910%')->get(),
            "categories" => \App\Models\IncomeCategory::latest()->get(),
            "number" => 1,
            "subtotal" => 0,
            "total" => 0
        ]);
    }
}