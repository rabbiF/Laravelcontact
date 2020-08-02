@extends('layouts.app') 
@section('content')
@inject('metrics', ' App\Http\Controllers\ClientController')
<div class="container">
    <div class="row">
    @include('layouts.menu')
        <div class="col-md-9 col-lg-10">
            @include('clients.partials.info')
            <div class="card card-default">
                <div class="card-header bg-info text-white">Editer client : {{ $client->id }} </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('client.update', ['client' => $client->id]) }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-5 col-lg-3 col-xl-2">
                                <label for="date_contact">Date de contact *</label>
                                <input id="date_contact" value="{{ $client->date_contact }}" type="date" class="form-control" name="date_contact" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="name">Nom *</label>
                                <input id="name" value="{{ $client->name }}" type="text" class="form-control" name="name" required>                         
                            </div>
                            <div class="form-group col-md-2">
                                <label for="firstname">Prénom</label>
                                <input id="firstname" value="{{ $client->firstname }}" type="text" class="form-control" name="firstname">                         
                            </div>
                            <div class="form-group col-md-3">
                                <label for="email">Email</label>
                                <input id="email" value="{{ $client->email }}" type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group col-md2">
                                <label for="tel">Tél. </label>
                                <input id="tel" value="{{ $client->phone }}" type="text" class="form-control" name="phone">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="contact_origine">Origine Contact</label>
                                <input id="contact_origine"  value="{{ $client->contact_origine }}" type="text" class="form-control" name="contact_origine">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="projet">Projet</label>
                                <select class="mdb-select md-form form-control" id="projet" name="projet" title="Projet">                                                                     
                                    <?=($metrics->staticSelect("Projet", $client->projet)) ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-lg-2">
                                <label for="type">Type de Bien *</label>
                                <select class="mdb-select md-form form-control" id="type_de_bien" name="type_de_bien[]" multiple title="Type de bien">
                                    <?php echo ($metrics->staticBien($client->type_de_bien))['optionBien'] ?>
                                </select> 
                            </div>
                            <div class="form-group col-md-2">
                                <label for="etat">Etat</label>
                                <select class="mdb-select md-form form-control" id="etat" name="etat" title="Etat">
                                    <?=$metrics->staticSelect("Etat", $client->etat) ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="secteur">Secteur</label>
                                <input id="secteur" value="{{ $client->secteur }}" type="text" class="form-control" name="secteur">                           
                            </div>
                            <div class="form-group col-md-3">
                                <label for="contact">Prise de contact</label>
                                <select class="mdb-select md-form form-control" id="contact" name="contact" title="Prise de contact">
                                    <?=$metrics->staticSelect("Contact", $client->contact) ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="suivi">Suivi</label>
                                <select class="mdb-select md-form form-control" id="suivi" name="suivi" title="Suivi">
                                    <?=$metrics->staticSelect("Suivi", $client->suivi) ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="budget">Budget</label>
                                <input id="budget" value="{{ $client->budget }}" type="text" class="form-control" name="budget">
                            </div>
                            <div class="form-group col-md-4 col-lg-3">
                                <label for="client_nego">Client Négo.</label>
                                <input id="client_nego" value="{{ $client->client_nego }}" type="text" class="form-control" name="client_nego">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="actif">Actif</label>                                
                                <select class="mdb-select md-form form-control" id="actif" name="actif" title="Actif">
                                    <?=$metrics->staticSelect("Actif", $client->actif) ?> 
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="options_color">Etiquettes</label>  
                                <div>
                                    <?=$metrics->staticOptionColor($client->options_color) ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="commentaires">Commentaires</label>
                            <textarea id="commentaires" class="form-control" name="commentaires" cols="5" rows="5">{{ $client->commentaires }}</textarea>
                        </div> 
   
                        <button type="submit" class="btn btn-success btn-sm">Sauvegarder</button>

                        <a href="/home" class="btn btn-primary btn-sm">Retour</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
$(function () {
    $('select').selectpicker();
});
@endsection