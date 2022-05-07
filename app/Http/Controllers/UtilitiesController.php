<?php

namespace App\Http\Controllers;

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
            
        }

        dd('Berhasil Login');
    }
    

    public function register()
    {
        return view('/pages/utilities/register', [
            "title" => "Login"
        ]);
    }

    public function registerstore(Request $request)
    {
        // return request()->all();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        // $validatedData['password'] = bcrypt($validatedData['passsword']);

        $validatedData['password'] = Hash::make($validatedData['password']);

        // $request->session()->flash('Success', 'Regist success');

        User::create($validatedData);

        // dd('Regis berhasil');

        return redirect('/')->with('success', 'Regist success');
    }


    public function chart()
    {
        return view('/pages/utilities/mychart', [
            "title" => "My Chart",
            "incomes" => Income::latest()->get(),
            "expenses" => Expense::latest()->get(),
            "debts" => Debt::latest()->get(),
            "incats" => \App\Models\IncomeCategory::latest()->get(),
            "excats" => \App\Models\ExpenseCategory::latest()->get(),
            "debcats" => \App\Models\DebtCategory::latest()->get(),
            "number" => 0,
            "subtotal" => 0,
            "total" => 0,
            "intotal" => 0,
            "extotal" => 0,
            "debtotal" => 0,
            "cashflow" => 0
        ]);
    }
}
