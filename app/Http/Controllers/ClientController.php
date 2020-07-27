<?php

namespace App\Http\Controllers;

use App\Model\Client;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Auth::user()->clients()->paginate(5);

        return view('clients.index')->with('clients', $clients);
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
            'date_contact' => 'required|date',
            'name' => 'required|min:2',
            'firstname' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required'
        ]); 

        $news = $request->input('type_de_bien');
        $news = implode(',', $news);        

        $client = Auth::user()->clients()->create([
            'date_contact' =>  $request->date_contact,
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact_origine' => $request->contact_origine,
            'projet' => $request->projet,
            'type_de_bien' => $news,
            'etat'=> $request->etat,
            'secteur' => $request->secteur,
            'commentaires' => $request->commentaires,
            'contact' => $request->contact,
            'suivi' => $request->suivi,
            'budget' => $request->budget,
            'client_nego' => $request->client_nego
        ]);

        $request->session()->flash('success', 'Insertion réussie.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $biens = DB::table('biens')
            ->join('bien_client', 'biens.id', '=', 'bien_client.bien_id')
            ->select('biens.*', 'bien_client.client_id')
            ->get();

        return view('clients.show')->with('client', $client)
            ->with('biens', $biens);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {        
        return view('clients.edit', compact('client', $client));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {    
        $news = $request->input('type_de_bien');
        $news = implode(',', $news);

        $client->update([
            'date_contact' =>  $request->date_contact,
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact_origine' => $request->contact_origine,
            'projet' => $request->projet,
            'type_de_bien' => $news,
            'etat'=> $request->etat,
            'secteur' => $request->secteur,
            'commentaires' => $request->commentaires,
            'contact' => $request->contact,
            'suivi' => $request->suivi,
            'budget' => $request->budget,
            'client_nego' => $request->client_nego
        ]);

        $request->session()->flash('success', 'Modification réussie.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        Session::flash('success', 'Suppression réussie.');
        return back();
    }

    public function search(Request $request)
    {
        $search = $request->query('bien');

        if(isset($search)){
            #formatage value search
            $search = $request->fullUrl();
            $search= explode('bien=', $search);
            unset($search[0]);
            $search = array_values($search);
            $search = str_replace("&", "", $search);
            $search = str_replace("%2F", "/", $search);
            $search = implode("|", $search);
            
            $result =  DB::table('clients')
                ->join('users', function ($join) 
                {
                    $join->on('clients.user_id', '=', 'users.id')
                         ->where('users.id', '=', Auth::id());
                })
                ->select('clients.*')
                ->where('clients.type_de_bien',"rlike", $search)
                ->paginate(10);
        }else{
            $search = $request->query('q');

            $result =  DB::table('clients')
                ->join('users', function ($join)
                {
                    $join->on('clients.user_id', '=', 'users.id')
                         ->where('users.id', '=', Auth::id());
                })
                ->select('clients.*')
                ->where('clients.email', 'like', '%'.$search.'%')
                ->orWhere('clients.phone', 'like', '%'.$search.'%')
                ->orWhere('clients.type_de_bien', 'like', '%'.$search.'%')
                ->orWhere('clients.name', 'like', '%'.$search.'%')
                ->orWhere('clients.firstname', 'like', '%'.$search.'%')
                ->paginate(10);
        }

        return view('result', compact('search', 'result'));      
    }

    public function download(Request $request)
    {  
        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=clients.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];

        $searchTel = $request->query('tel_search');
        $searchMail = $request->query('mail_search');
        $searchBien = $request->query('bien');
        $searchUrl =  $request->fullUrl();

        if(isset($searchTel)){
            $list = Auth::user()->clients()
            ->select('phone')
            ->where('clients.email', 'like', '%'.$searchTel.'%')
            ->orWhere('clients.phone', 'like', '%'.$searchTel.'%')
            ->orWhere('clients.type_de_bien', 'like', '%'.$searchTel.'%')
            ->orWhere('clients.name', 'like', '%'.$searchTel.'%')
            ->orWhere('clients.firstname', 'like', '%'.$searchTel.'%')
            ->get()
            ->toArray();
        }

        if(isset($searchMail)){
            $list = Auth::user()->clients()
            ->select('email')
            ->where('clients.email', 'like', '%'.$searchMail.'%')
            ->orWhere('clients.phone', 'like', '%'.$searchMail.'%')
            ->orWhere('clients.type_de_bien', 'like', '%'.$searchMail.'%')
            ->orWhere('clients.name', 'like', '%'.$searchMail.'%')
            ->orWhere('clients.firstname', 'like', '%'.$searchMail.'%')
            ->get()
            ->toArray();
        }        

        if(empty($list)){
            if(isset($searchBien)){

                # formatage Get bien
                $searchBien = $searchUrl;
                $searchBien = explode('bien', $searchBien);
                unset($searchBien[0]);
                $searchBien = array_values($searchBien);
                $searchArray = ["&tel_search=","&mail_search=","="];
                $replaceArray = [""];
                $searchBien = str_replace($searchArray, $replaceArray, $searchBien);
                $searchBien = str_replace("%2F", "/", $searchBien);
                $searchBien = implode("|", $searchBien);

                # if clic btn export tel.
                if(strpos($searchUrl, "tel_search")){
                    $list = Auth::user()->clients()
                        ->select('phone')  
                        ->where('clients.type_de_bien',"rlike", $searchBien)
                        ->get()
                        ->toArray();
                }
                # if clic btn export mail.
                if(strpos($searchUrl, "mail_search")){
                    $list = Auth::user()->clients()
                    ->select('email')
                    ->where('clients.type_de_bien',"rlike", $searchBien)
                    ->get()
                    ->toArray();
                }
            }
        }

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