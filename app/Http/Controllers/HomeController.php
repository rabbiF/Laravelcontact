<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Client;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth()->user()->isAdmin == 1) {   
            $user = DB::table('users')->select('users.*')->paginate(15);      
            return view('admin.index')->with('user', $user);
        }else{
            $clients = Auth::user()->clients()->paginate(5);
            return view('clients.index')->with('clients', $clients);
        }        
    }

}
