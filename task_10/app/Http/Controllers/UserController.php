<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $users = DB::table('users')
            ->select('*')
            ->get();
        return view('users.index')->with('users', $users);
    }

}
