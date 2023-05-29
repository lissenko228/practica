<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        if(Auth::check())
        {
            return view('timeline.index');
        }

        return view('home');
    }
}
