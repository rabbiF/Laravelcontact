@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
    @include('layouts.menu')
        <div class="col-md-9 col-lg-10">
    @include('clients.partials.info')
            <div class="card card-default">
                <div class="card-header bg-info text-white">Detail client : {{ $client->id }} </div>
                <div class="card-body">    
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-3 col-lg-2">
                                <label for="date_contact">Date de contact</label>
                                <input id="date_contact" value="{{ \Carbon\Carbon::parse($client->date_contact)->format('d/m/Y') }}" disabled type="text" class="form-control" name="date_contact">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fullname">Nom et Prénom</label>                            
                                <input id="fullname" value="{{ $client->name }} {{ $client->firstname }}" disabled type="text" class="form-control" name="name">                         
                            </div>
                            <div class="form-group col-md-3">
                                <label for="email">Email</label>
                                <input id="email" value="{{ $client->email }}" disabled type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group col-md2">
                                <label for="tel">Tél.</label>
                                <input id="tel" value="{{ $client->phone }}" disabled type="text" class="form-control" name="phone">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="contact_origine">Origine Contact</label>
                                <input id="contact_origine"  value="{{ $client->contact_origine }}" disabled type="text" class="form-control" name="contact_origine">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="projet">Projet</label>
                                <input id="projet" value="{{ $client->projet }}" disabled type="text" class="form-control" name="projet">
                            </div>
                            <div class="form-group col-md-3 col-lg-2">
                                <label for="type_de_bien">Type de Bien</label>
                                <input id="type_de_bien" value="{{ $client->type_de_bien }}" disabled type="text" class="form-control" name="type_de_bien">
                            </div>                                  
                            <div class="form-group col-md-2">
                                <label for="etat">Etat</label>
                                <input id="etat" value="{{ $client->etat }}" disabled type="text" class="form-control" name="etat">
                            </div>                            
                            <div class="form-group col-md-3">
                                <label for="secteur">Secteur</label>
                                <input id="secteur" value="{{ $client->secteur }}" disabled type="text" class="form-control" name="secteur">
                            </div>                            
                            <div class="form-group col-md-3">
                                <label for="contact">Prise de contact</label>
                                <input id="contact" value="{{ $client->contact }}" disabled type="text" class="form-control" name="contact">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="suivi">Suivi</label>
                                <input id="suivi" value="{{ $client->suivi }}" disabled type="text" class="form-control" name="suivi">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="budget">Budget</label>
                                <input id="budget" value="{{ $client->budget }}" disabled type="text" class="form-control" name="budget">
                            </div>                            
                            <div class="form-group col-md-3 col-lg-3">
                                <label for="visites">Visites Effectuées</label>
                                <input id="visites" value="{{ $client->visites }}" disabled type="text" class="form-control" name="visites">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="client_nego">Client Négo.</label>
                                <input id="client_nego" value="{{ $client->client_nego }}" disabled type="text" class="form-control" name="client_nego">
                            </div>                                                     
                        </div>

                        <div class="form-group">
                            <label for="commentaires">Commentaires</label>
                            <textarea id="commentaires" class="form-control" disabled name="commentaires" cols="5" rows="5">{{ $client->commentaires }}</textarea>                            
                        </div> 

                        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Retour</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
