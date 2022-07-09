<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use PDF;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


// MODEL
use App\Models\User;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Debt;

// MODEL CATEGORY
use App\Models\IncomeCategory;
use App\Models\ExpenseCategory;
use App\Models\DebtCategory;

class UtilitiesController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | MYCHART TO LOGIN MANAGEMENT
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        return view('/pages/utilities/login', [
            "title" => "Login",
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended('/income');
        }

        return back()->with('loginError', 'Login failed!');

        // dd('Berhasil Login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return redirect('/');
    }

    /*
    |--------------------------------------------------------------------------
    | MYCHART TO PRINT
    |--------------------------------------------------------------------------
    */

    public function chart()
    {

        // List order by date
        $incomes = DB::table('incomes')
        ->select('income_description', 'income_nominal', 'income_categories.incat_name')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->get();

        // List order by date
        $expenses = DB::table('expenses')
        ->select('expense_description', 'expense_nominal', 'expense_categories.excat_name')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->get();

        // List order by date
        $debts = DB::table('debts')
        ->select('debt_description', 'debt_nominal', 'debt_categories.debcat_name')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->get();

        return view('/pages/utilities/mychart', [
            // Title
            "title" => "Cash Flow",

            // All List
            "incomes" => $incomes,
            "expenses" => $expenses,
            "debts" => $debts,

            // All Category
            "incats" => \App\Models\IncomeCategory::latest()->get(),
            "excats" => \App\Models\ExpenseCategory::latest()->get(),
            "debcats" => \App\Models\DebtCategory::latest()->get(),
            
            // Counting 
            "number" => 0,
            "subtotal" => 0,
            "total" => 0,

            // GROUP
            "intotal" => 0,
        ]);
    }

    public function printstore()
    {      
        // List order by date
        $incomes = DB::table('incomes')
        ->select('income_description', 'income_nominal', 'income_categories.incat_name')
        ->join('income_categories', 'income_categories.id', '=', 'income_category_id')
        ->get();

        // List order by date
        $expenses = DB::table('expenses')
        ->select('expense_description', 'expense_nominal', 'expense_categories.excat_name')
        ->join('expense_categories', 'expense_categories.id', '=', 'expense_category_id')
        ->get();

        // List order by date
        $debts = DB::table('debts')
        ->select('debt_description', 'debt_nominal', 'debt_categories.debcat_name')
        ->join('debt_categories', 'debt_categories.id', '=', 'debt_category_id')
        ->get();


        return view('/pages/utilities/printchart', [
            // Title
            "title" => "Cash Flow",
            "bck" => "income",

            // All List
            "incomes" => $incomes,
            "expenses" => $expenses,
            "debts" => $debts,

            // All Category
            "incats" => \App\Models\IncomeCategory::latest()->get(),
            "excats" => \App\Models\ExpenseCategory::latest()->get(),
            "debcats" => \App\Models\DebtCategory::latest()->get(),
            
            // Counting 
            "number" => 0,
            "subtotal" => 0,
            "total" => 0,

            // Calculation
            "intotal" => 0,
            "extotal" => 0,
            "debtotal" => 0,
            "cashflow" => 0
        ]);
    }





























    /*
    |--------------------------------------------------------------------------
    | USER TO USERLANDING
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        // if (auth()->guest()) 
        // {
        //     abort(403);
        // }

        // if (auth()->user()->username != 'user')
        // {
        //     abort(403);
        // }

        return view('/pages/users/users', [
            "title" => "User Management",
            "users" => User::latest()->get(),
            "number" => 1,
            "editcategoryjs" => 0,
            "edits" => User::latest()->get(),
            "entry" => 1,
            "entries" => 0
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | USER TO ADD NEW
    |--------------------------------------------------------------------------
    */

    public function userstore(Request $request)
    {
        // return request()->all();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'user_slug' => 'required|max:255',
            'password' => 'required|min:5|max:255'
        ]);

        // $validatedData['password'] = bcrypt($validatedData['passsword']);

        $validatedData['password'] = Hash::make($validatedData['password']);

        // $request->session()->flash('Success', 'Regist success');

        User::create($validatedData);

        // dd($validatedData);

        return view('/pages/users/users', [
            "title" => "User Management",
            "users" => User::latest()->get(),
            "number" => 1,
            "editcategoryjs" => 0,
                        "edits" => User::latest()->get(),

            "entry" => 1,
            "entries" => 0
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | USER TO EDIT USERS
    |--------------------------------------------------------------------------
    */

    public function edituserlanding($user_slug)
    {
        $specific = DB::table('users')->where('user_slug',$user_slug)->get();

        return view('/pages/users/users', [
            "title" => "User Management",
            "users" => User::latest()->get(),
            "edits" => $specific,
            "number" => 1,
            "editcategoryjs" => 1,
                        "edits" => User::latest()->get(),

            "entry" => 0,
            "entries" => 0
        ]);
    }

    public function edituser(Request $request, $user_slug)
    {
        $request->password = Hash::make($request->password);

        DB::table('users')->where('user_slug', $user_slug)->update([
            'name'=>$request->full_name,
            'username'=>$request->username,
            'user_slug'=>$request->user_slug,
            'password'=>$request->password
		]);
        
        return view('/pages/users/users', [
            "title" => "User Management",
            "users" => User::latest()->get(),
            "number" => 1,
            "editcategoryjs" => 0,
                        "edits" => User::latest()->get(),

            "entry" => 0,
            "entries" => 0
        ]);
    }



    /*
    |--------------------------------------------------------------------------
    | USER TO DELETE USERS
    |--------------------------------------------------------------------------
    */

    public function deleteuser($user_slug)
    {
        DB::table('users')->where('user_slug',$user_slug)->delete();        

        return view('/pages/users/users', [
            "title" => "User Management",
            "users" => User::latest()->get(),
            "number" => 1,
            "editcategoryjs" => 0,
                        "edits" => User::latest()->get(),

            "entry" => 0,
            "entries" => 0
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | EMERGENCY
    |--------------------------------------------------------------------------
    */
    public function emergency()
    {
        return view('/pages/utilities/emergency', [
            "title" => "Login",
        ]);
    }

    public function emergency404(Request $request)
    {
        // return request()->all();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'user_slug' => 'required|max:255',
            'password' => 'required|min:5|max:255'
        ]);

        // $validatedData['password'] = bcrypt($validatedData['passsword']);

        $validatedData['password'] = Hash::make($validatedData['password']);

        // $request->session()->flash('Success', 'Regist success');

        User::create($validatedData);

        // dd($validatedData);

        return view('/pages/utilities/login', [
            "title" => "User Management",
            "users" => User::latest()->get(),
            "number" => 1,
            "editcategoryjs" => 0,
        ]);
    }
}