<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

// MODEL
use App\Models\User;

class UtilitiesController extends Controller
{
    public function login()
    {
        return view('/pages/utilities/login', [
            "title" => "Login"
        ]);
    }
}
