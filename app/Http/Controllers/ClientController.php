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
        $clients = Auth::user()->clients()->orderBy('date_contact', 'desc')->get();

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
            'name' => 'required|min:2'
        ]); 
        
        if(is_array($request->input('type_de_bien'))) {
            $news = $request->input('type_de_bien');
            $news = implode(',', $news);  
        }else{
            $news = $request->input('type_de_bien');
        }
        
        if(is_array($request->input('etat'))) {
            $etat = $request->input('etat');
            $etat = implode(',', $etat);  
        }else{
            $etat = $request->input('etat');
        }

        $client = Auth::user()->clients()->create([
            'date_contact' =>  $request->date_contact,
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact_origine' => $request->contact_origine,
            'projet' => $request->projet,
            'type_de_bien' => $news,
            'etat'=> $etat,
            'secteur' => $request->secteur,
            'commentaires' => $request->commentaires,
            'contact' => $request->contact,
            'suivi' => $request->suivi,
            'budget' => $request->budget,
            'client_nego' => $request->client_nego,
            'actif' => $request->actif,
            'options_color' => $request->options_color,
            'options_secteur' => $request->options_secteur
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
        $this->validate($request, [
            'date_contact' => 'required|date',
            'name' => 'required|min:2'
        ]);

        if(is_array($request->input('type_de_bien'))) {
            $news = $request->input('type_de_bien');
            $news = implode(',', $news);
        }else{
            $news = $request->input('type_de_bien');
        }

        if(is_array($request->input('etat'))) {
            $etat = $request->input('etat');
            $etat = implode(',', $etat);  
        }else{
            $etat = $request->input('etat');
        }

        $client->update([
            'date_contact' =>  $request->date_contact,
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact_origine' => $request->contact_origine,
            'projet' => $request->projet,
            'type_de_bien' => $news,
            'etat'=> $etat,
            'secteur' => $request->secteur,
            'commentaires' => $request->commentaires,
            'contact' => $request->contact,
            'suivi' => $request->suivi,
            'budget' => $request->budget,
            'client_nego' => $request->client_nego,
            'actif' => $request->actif,
            'options_color' => $request->options_color,
            'options_secteur' => $request->options_secteur
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
            
            $searchEtat = $request->query('etat');
            $searchActif = $request->query('actif');

            if(isset($searchEtat) && isset($searchActif)){ 
                $search = str_replace("etat=".$searchEtat, "", $search);
                $search = str_replace("etat=Neuf", "", $search);

                $searchEtat= explode('etat=', $request->fullUrl());
                unset($searchEtat[0]);
                $searchEtat = array_values($searchEtat);
                $searchEtat = str_replace("&", "", $searchEtat);
                $searchEtat = str_replace("%2F", "/", $searchEtat);
                $searchEtat = implode("|", $searchEtat);

                $result =  DB::table('clients')
                ->join('users', function ($join) 
                {
                    $join->on('clients.user_id', '=', 'users.id')
                         ->where('users.id', '=', Auth::id());
                })
                ->select('clients.*')
                ->where([
                    ['clients.etat','rlike', $searchEtat],
                    ['clients.actif','=', $searchActif],
                    ['clients.type_de_bien',"rlike", $search],
                ])
                ->orderBy('date_contact', 'desc')
                ->get();
            }elseif(isset($searchActif)){
                $search = str_replace("actif=".$searchActif, "", $search);

                $result =  DB::table('clients')
                ->join('users', function ($join) 
                {
                    $join->on('clients.user_id', '=', 'users.id')
                         ->where('users.id', '=', Auth::id());
                })
                ->select('clients.*')
                ->where([
                    ['clients.type_de_bien',"rlike", $search],
                    ['clients.actif','=', $searchActif],
                ])
                ->orderBy('date_contact', 'desc')
                ->get();
            }else{
                $result =  DB::table('clients')
                ->join('users', function ($join) 
                {
                    $join->on('clients.user_id', '=', 'users.id')
                         ->where('users.id', '=', Auth::id());
                })
                ->select('clients.*')
                ->where('clients.type_de_bien',"rlike", $search)
                ->orderBy('date_contact', 'desc')
                ->get();
            }
            
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
                ->orderBy('date_contact', 'desc')
                ->get();
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
        $searchEtat = $request->query('etat');
        $searchActif = $request->query('actif');

        if(strpos($searchUrl, "tel_search")){
            if(isset($searchTel)){
                $list =  Auth::user()->clients()
                ->select('phone')
                ->where([
                    ['clients.user_id', '=', Auth::id()],
                    ['clients.phone', '!=', 'null'],
                ])
                ->orWhere([
                    ['clients.phone', 'like', '%'.$searchTel.'%'],
                    ['clients.email', 'like', '%'.$searchTel.'%'],
                ])
                ->orWhere('clients.name', 'like', '%'.$searchTel.'%')
                ->orWhere('clients.firstname', 'like', '%'.$searchTel.'%')
                ->orderBy('date_contact', 'desc')
                ->get()
                ->toArray();
            }elseif(!isset($searchBien)){
                $list =  Auth::user()->clients()
                ->select('phone')
                ->where([
                    ['clients.user_id', '=', Auth::id()],
                    ['clients.phone', '!=', 'null'],
                ])
                ->orderBy('date_contact', 'desc')
                ->get()
                ->toArray();
            }

        }

        if(strpos($searchUrl, "mail_search")){
            if(isset($searchMail)){
                $list = Auth::user()->clients()
                ->select('email')
                ->where([
                    ['clients.user_id', '=', Auth::id()],
                    ['clients.email', '!=', 'null'],
                ])
                ->orWhere([
                    ['clients.phone', 'like', '%'.$searchMail.'%'],
                    ['clients.email', 'like', '%'.$searchMail.'%'],
                ])
                ->orWhere('clients.name', 'like', '%'.$searchMail.'%')
                ->orWhere('clients.firstname', 'like', '%'.$searchMail.'%')
                ->orderBy('date_contact', 'desc')
                ->get()
                ->toArray();
            }elseif(!isset($searchBien)){
                $list =  Auth::user()->clients()
                ->select('email')
                ->where([
                    ['clients.user_id', '=', Auth::id()],
                    ['clients.email', '!=', 'null'],
                ])
                ->orderBy('date_contact', 'desc')
                ->get()
                ->toArray();
            }
        }

        if(empty($list)){
            if(isset($searchBien)){

                # formatage Get bien
                $searchBien = $searchUrl;
                $searchBien = explode('bien', $searchBien);
                unset($searchBien[0]);
                $searchBien = array_values($searchBien);
                $searchArray = ["&tel_search=","&mail_search=","&etat","&actif","Neuf","Ancien","etat","v","="];
                $replaceArray = [""];
                $searchBien = str_replace($searchArray, $replaceArray, $searchBien);
                $searchBien = str_replace("%2F", "/", $searchBien);
                $searchBien = implode("|", $searchBien);
                
                $searchBien = str_replace($searchEtat, "", $searchBien);
                $searchBien = str_replace($searchActif, "", $searchBien);

                $searchEtat = $searchUrl;
                $searchEtat = explode('etat', $searchEtat);
                unset($searchEtat[0]);
                $searchEtat = array_values($searchEtat);
                $searchArray = ["&tel_search=","&mail_search=","&etat","&actif","="];
                $replaceArray = [""];
                $searchEtat = str_replace($searchArray, $replaceArray, $searchEtat);
                $searchEtat = str_replace("%2F", "/", $searchEtat);
                $searchEtat = implode("|", $searchEtat);
                
                # if clic btn export tel.
                if(strpos($searchUrl, "tel_search")){
                    if(isset($searchEtat) || isset($searchActif)){
                        if(isset($searchEtat) && isset($searchActif)){
                            $list = Auth::user()->clients()
                            ->select('phone')
                            ->where([
                                ['clients.user_id', '=', Auth::id()],
                                ['clients.type_de_bien',"rlike", $searchBien],
                                ['clients.etat',"rlike", $searchEtat],
                                ['clients.actif',"=", $searchActif],
                                ['clients.phone', '!=', 'null'],
                            ])                         
                            ->orderBy('date_contact', 'desc')
                            ->get()
                            ->toArray();
                        }elseif(isset($searchActif)){
                            $list = Auth::user()->clients()
                            ->select('phone')
                            ->where([
                                ['clients.user_id', '=', Auth::id()],
                                ['clients.type_de_bien',"rlike", $searchBien],
                                ['clients.actif',"=", $searchActif],
                                ['clients.phone', '!=', 'null'],
                            ])
                            ->orderBy('date_contact', 'desc')
                            ->get()
                            ->toArray();
                        }
                    }else{
                        $list = Auth::user()->clients()
                        ->select('phone')
                        ->where([
                            ['clients.user_id', '=', Auth::id()],
                            ['clients.type_de_bien',"rlike", $searchBien],
                            ['clients.phone', '!=', 'null'],
                        ])
                        ->orderBy('date_contact', 'desc')
                        ->get()
                        ->toArray();
                    }
                }
                # if clic btn export mail.
                if(strpos($searchUrl, "mail_search")){
                    if(isset($searchEtat) || isset($searchActif)){
                        if(isset($searchEtat) && isset($searchActif)){
                            $list = Auth::user()->clients()
                            ->select('email')
                            ->where([
                                ['clients.user_id', '=', Auth::id()],
                                ['clients.type_de_bien',"rlike", $searchBien],
                                ['clients.etat',"rlike", $searchEtat],
                                ['clients.actif',"=", $searchActif],
                                ['clients.email', '!=', 'null'],
                            ])
                            ->orderBy('date_contact', 'desc')
                            ->get()
                            ->toArray();
                        }elseif(isset($searchActif)){
                            $list = Auth::user()->clients()
                            ->select('email')
                            ->where([
                                ['clients.user_id', '=', Auth::id()],
                                ['clients.type_de_bien',"rlike", $searchBien],
                                ['clients.actif',"=", $searchActif],
                                ['clients.email', '!=', 'null'],
                            ])
                            ->orderBy('date_contact', 'desc')
                            ->get()
                            ->toArray();
                        }
                    }else{
                        $list = Auth::user()->clients()
                        ->select('email')
                        ->where([
                            ['clients.user_id', '=', Auth::id()],
                            ['clients.type_de_bien',"rlike", $searchBien],
                            ['clients.email', '!=', 'null'],
                        ])                        
                        ->orderBy('date_contact', 'desc')
                        ->get()
                        ->toArray();
                    }
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

    public static function staticBien($selected = null){
        $optionArray = ["T1","T2","T3","T4","T5","T6","T7","Villas/Maison","Locaux/Bureaux","Terrain","Garage","NC"];
        $optionArrayColor = ["primary","secondary","success","danger","warning","info","pink","dark","darkred","purple","yellow","coral"];
        $optionBien = $optionColor = "";

        if(isset($selected)){ 
            $selected = explode(",", $selected);

            foreach($optionArray as $key => $opt) {
                if(in_array($opt, $selected)) {
                    $optionBien .= "<option value='".$opt."' selected>".$opt."</option>";
                    $optionColor .= "<span class='p-2 pb-0 pt-0 mt-1 mr-1 bg-".$optionArrayColor[$key]." text-white col-2 h-25 d-inline-block border rounded' style='width: 30px;'></span>";                     
                }else{
                    $optionBien .= "<option value='".$opt."'>".$opt."</option>";
                }
            }

        }else{
            foreach($optionArray as $opt) {
                $optionBien .= "<option value='".$opt."'>".$opt."</option>";
            }
        }
        $return = array(
            "optionBien" => $optionBien,
            "optionColor" => $optionColor
        );
        return $return;
    }
    
    public static function staticOptionColor($selected = null){
        $optionArray = ["secondary","darkred","purple","success","coral","white"];
        $optionColor = "";

        if(isset($selected)){

            foreach($optionArray as $key => $opt) {
                if($opt == $selected) {
                    $optionColor.= "<div class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='options_color' id='options_color".$opt."' value='".$opt."' checked>
                                        <label class='form-check-label' for='options_color".$opt."'><span class='p-2 pb-0 pt-0 mt-1 mr-1 bg-".$opt." text-white col-2 h-25 d-inline-block border rounded-circle' style='width: 18px; height: 18px;'></span></label>
                                    </div>";
                }else{
                    $optionColor.= "<div class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='options_color' id='options_color".$opt."' value='".$opt."'>
                                        <label class='form-check-label' for='options_color".$opt."'><span class='p-2 pb-0 pt-0 mt-1 mr-1 bg-".$opt." text-white col-2 h-25 d-inline-block border rounded-circle' style='width: 18px; height: 18px;'></span></label>
                                    </div>";
                }
            }

        }else{
            foreach($optionArray as $opt) {
                $optionColor .= "<div class='form-check form-check-inline'>
                                    <input class='form-check-input' type='radio' name='options_color' id='options_color".$opt."' value='".$opt."'>
                                    <label class='form-check-label' for='options_color".$opt."'><span class='p-2 pb-0 pt-0 mt-1 mr-1 bg-".$opt." text-white col-2 h-25 d-inline-block border rounded-circle' style='width: 18px; height: 18px;'></span></label>
                                </div>";
            }
        }
        
        return $optionColor;
    }

    public static function staticSelect($type, $selected = null){
        $option = "";
        $optionArray = [];

        switch ($type){
            case "Actif":
                $optionArray = ["Oui","Non"];
                break;
            case "Suivi":
                $optionArray = ["A rappeler","A relancer","Contrat/compromis signé","Acte signé"];
                break;            
            case "Contact":
                $optionArray = ["Tel","Sms","Mail","Direct"];
                break;
            case "Etat":
                $optionArray = ["Neuf","Ancien"];
                break;
            case "Projet":
                $optionArray = ["Location","Achat/Vente","Investissement"];
                break;
        }

        if(isset($selected)){
            $selected = explode(",", $selected);

            foreach($optionArray as $key => $opt) {
                if(in_array($opt, $selected)) {
                    $option.= "<option value='".$opt."' selected>".$opt."</option>";
                }else{
                    $option.= "<option value='".$opt."'>".$opt."</option>";
                }
            }

        }else{
            foreach($optionArray as $opt) {
                $option .= "<option value='".$opt."'>".$opt."</option>";
            }
        }
        
        return $option;
    }
}