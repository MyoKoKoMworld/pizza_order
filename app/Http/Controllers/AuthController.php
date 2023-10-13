<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    //auth login
    function loginpage(){
        return view('login');
    }

    //auth register
    function registerPage(){
        return view('register');
    }

    //dashboard
    function dashboard(){
        // dd(Auth::user()->role);
        if(Auth::user()->role == "admin"){
            return redirect()->route('category#list');
        }
        return redirect()->route('user#home');
    }


}
