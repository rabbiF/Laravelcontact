<?php

namespace App\Http\Controllers;

use App\Model\Bien;
use Illuminate\Http\Request;
use Auth;
use Session;

class BienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Validation des données saisi
        $this->validate($request, [
            'name' => 'required|min:2'
        ]);

        $bien = new Bien;
        // Auth::id() renvoi l'identifiant de l'utilisateur connecté
        $bien->user_id = Auth::id();
        $bien->name = $request->name;
        $bien->save();

        // Envoi d'une variable de session
        $request->session()->flash('success', 'Insertion réussie.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Bien  $bien
     * @return \Illuminate\Http\Response
     */
    public function show(bien $bien)
    {
        return view('biens.show',compact('bien', $bien));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Bien  $bien
     * @return \Illuminate\Http\Response
     */
    public function edit(Bien $bien)
    {
        return view('biens.edit', compact('bien', $bien));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Bien  $bien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bien $bien)
    {
        $this->validate($request, [
            'name' => 'required|min:4'
        ]);

        $bien->name = $request->name;
        $bien->save();

        $request->session()->flash('success', 'Modification réussie.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Bien  $bien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bien $bien)
    {
        $bien->delete();
        Session::flash('success', 'Suppression réussie.');

        return redirect()->route('home');
    }
}
