<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Status;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        if(Auth::check())
        {
            $statuses=Status::notReply()->where(
                function($query)
                {
                    return $query->where('user_id', Auth::user()->id)->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
                }
            )->orderBy('created_at', 'desc')->paginate(5);

            return view('timeline.index', compact('statuses'));
        }

        return view('home');
    }

    function showMore()
    {
        if(Auth::check())
        {

            $statuses=Status::notReply()->where(
                function($query)
                {
                    return $query->where('user_id', Auth::user()->id)->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
                }
            )->orderBy('created_at', 'desc')->get();

            return view('timeline.showmore', compact('statuses'));

            // $statuses=Status::notReply()->where(
            //     function($query)
            //     {
            //         return $query->where('user_id', Auth::user()->id)->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
            //     }
            // )->orderBy('created_at', 'desc')->get();

            // $response['data']=$statuses;
            // return response()->json($response);
        }

        return redirect()->view('home');
    }
}
