<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class AdminController extends Controller
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

    public function index()
    { 
        $user = DB::table('users')->select('users.*')->paginate(15);
        return view('admin.index')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'isAdmin' => 'required',
            'name' => 'required|min:2',            
            'email' => 'required|email',
            'password' => 'required'
        ]);      

        $user = DB::table('users')->insert([
            'isAdmin' =>  $request->isAdmin,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
            

        $request->session()->flash('success', 'Insertion réussie.');
        return back();
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {        
        return view('admin.edit', compact('user', $user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {       
        $this->validate($request, [
            'isAdmin' => 'required',
            'name' => 'required|min:2',            
            'email' => 'required|email',
            'password' => 'required'
        ]);  

        //$user->update($request->all());       

        $user->update([
            'isAdmin' =>  $request->isAdmin,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $request->session()->flash('success', 'Modification réussie.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        Session::flash('success', 'Suppression réussie.');
        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientsAll()
    {
        if(Auth()->user()->isAdmin == 1) {
            $clientsAll = DB::table('clients')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->select('clients.*', 'users.email as email_mandataires')
            ->paginate(15);
            return view('admin.clients', compact('clientsAll', $clientsAll));
        }else{
            $clients = Auth::user()->clients()->paginate(5);
            return view('clients.index')->with('clients', $clients);
        }        
    }

    public function download()
    {          
        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=admin.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ]; 
        
        $list =  Client::all()->toArray();

        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers);  
         
    }

}