@extends('layouts.app') 
@section('content')
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
                            <div class="form-group col-md-3 col-lg-2">
                                <label for="date_contact">Date de contact *</label>
                                <input id="date_contact" value="{{ $client->date_contact }}" type="date" class="form-control" name="date_contact" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="name">Nom *</label>
                                <input id="name" value="{{ $client->name }}" type="text" class="form-control" name="name" required>                         
                            </div>
                            <div class="form-group col-md-2">
                                <label for="firstname">Prénom *</label>
                                <input id="firstname" value="{{ $client->firstname }}" type="text" class="form-control" name="firstname" required>                         
                            </div>
                            <div class="form-group col-md-3">
                                <label for="email">Email *</label>
                                <input id="email" value="{{ $client->email }}" type="text" class="form-control" name="email" required>
                            </div>
                            <div class="form-group col-md2">
                                <label for="tel">Tél. * </label>
                                <input id="tel" value="{{ $client->phone }}" type="text" class="form-control" name="phone" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="contact_origine">Origine Contact</label>
                                <input id="contact_origine"  value="{{ $client->contact_origine }}" type="text" class="form-control" name="contact_origine">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="projet">Projet</label>
                                <?php
                                    $option1="<option value='Location'>Location</option>
                                    <option value='Achat/Vente'>Achat/Vente</option>
                                    <option value='Investissement'>Investissement</option>";
                                    switch ($client->projet){
                                        case "Location":
                                            $option1="<option value='Achat/Vente'>Achat/Vente</option>
                                            <option value='Investissement'>Investissement</option>";
                                        break;
                                        case "Achat/Vente":
                                            $option1="<option value='Location'>Location</option>
                                            <option value='Investissement'>Investissement</option>";
                                        break;
                                        case "Investissemment":
                                            $option1="<option value='Achat/Vente'>Achat/Vente</option>
                                            <option value='Location'>Location/option>";
                                        break;
                                    }
                                ?>
                                <select class="mdb-select md-form form-control" id="projet" name="projet" title="Projet">
                                    <option value="" disabled>Projet</option>
                                    <option value="{{ $client->projet }}" selected>{{ $client->projet }}</option>
                                    <?php echo $option1; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-lg-2">
                                <label for="type">Type de Bien *</label>
                                <?php
                                    $option2="<option value='T1'>T1</option>
                                    <option value='T2'>T2</option>
                                    <option value='T3'>T3</option>
                                    <option value='T4'>T4</option>
                                    <option value='T5'>T5</option>
                                    <option value='T6'>T6</option>
                                    <option value='T7'>T7</option>
                                    <option value='Villas/Maison'>Villas/Maison</option>
                                    <option value='Locaux/Bureaux'>Locaux/Bureaux</option>
                                    <option value='Terrain'>Terrain</option>
                                    <option value='Garage'>Garage</option>";

                                    switch ($client->type_de_bien){
                                        case "T1":
                                            $option2="<option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='T6'>T6</option>
                                            <option value='T7'>T7</option>
                                            <option value='Villas/Maison'>Villas/Maison</option>
                                            <option value='Locaux/Bureaux'>Locaux/Bureaux</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Garage'>Garage</option>";
                                        break;
                                        case "T2":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='T6'>T6</option>
                                            <option value='T7'>T7</option>
                                            <option value='Villas/Maison'>Villas/Maison</option>
                                            <option value='Locaux/Bureaux'>Locaux/Bureaux</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Garage'>Garage</option>";
                                        break;
                                        case "T3":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='T6'>T6</option>
                                            <option value='T7'>T7</option>
                                            <option value='Villas/Maison'>Villas/Maison</option>
                                            <option value='Locaux/Bureaux'>Locaux/Bureaux</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Garage'>Garage</option>";
                                        break;
                                        case "T4":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T5'>T5</option>
                                            <option value='T6'>T6</option>
                                            <option value='T7'>T7</option>
                                            <option value='Villas/Maison'>Villas/Maison</option>
                                            <option value='Locaux/Bureaux'>Locaux/Bureaux</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Garage'>Garage</option>";
                                        break;
                                        case "T5":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T6'>T6</option>
                                            <option value='T7'>T7</option>
                                            <option value='Villas/Maison'>Villas/Maison</option>
                                            <option value='Locaux/Bureaux'>Locaux/Bureaux</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Garage'>Garage</option>";
                                        break; 
                                        case "T6":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='T7'>T7</option>
                                            <option value='Villas/Maison'>Villas/Maison</option>
                                            <option value='Locaux/Bureaux'>Locaux/Bureaux</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Garage'>Garage</option>";
                                        break;
                                        case "T7":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='T6'>T7</option>
                                            <option value='Villas/Maison'>Villas/Maison</option>
                                            <option value='Locaux/Bureaux'>Locaux/Bureaux</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Garage'>Garage</option>";
                                        break;
                                        case "Villas/Maison":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='T6'>T6</option>
                                            <option value='T7'>T7</option>
                                            <option value='Locaux/Bureaux'>Locaux/Bureaux</option> 
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Garafe'>Garage</option>";
                                        break;
                                        case "Locaux/Bureaux":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='T6'>T6</option>
                                            <option value='T7'>T7</option>
                                            <option value='Villas/Maison'>Villas/Maison</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Garage'>Garage</option>";
                                        break;
                                        case "Terrain":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='T6'>T6</option>
                                            <option value='T7'>T7</option>
                                            <option value='Villas/Maison'>Villas/Maison</option>
                                            <option value='Locaux/Bureaux'>Locaux/Bureaux</option>
                                            <option value='Garage'>Garage</option>";
                                        break;
                                        case "Garage":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='T6'>T6</option>
                                            <option value='T7'>T7</option>
                                            <option value='Villas/Maison'>Villas/Maison</option>
                                            <option value='Locaux/Bureaux'>Locaux/Bureaux</option>
                                            <option value='Terrain'>Terrain</option>";
                                        break;
                                    }
                                ?>

                                <select class="mdb-select md-form form-control" id="type_de_bien" name="type_de_bien[]" multiple title="type_de_bien">
                                    <option value="{{ $client->type_de_bien }}" selected>{{ $client->type_de_bien }}</option>
                                    <?php echo $option2; ?>
                                </select> 
                            </div>                                  
                            <div class="form-group col-md-2">
                                <label for="etat">Etat</label>
                                
                                <?php
                                    $option3="<option value='Neuf'>Neuf</option>
                                    <option value='Ancien'>Ancien</option>
                                    <option value='Neuf/Ancien'>Neuf/Ancien</option>";
                                    switch ($client->etat){
                                        case "Neuf":
                                            $option3="<option value='Ancien'>Ancien</option>
                                            <option value='Neuf/Ancien'>Neuf/Ancien</option>";
                                        break;
                                        case "Ancien":
                                            $option3="<option value='Neuf'>Neuf</option>
                                            <option value='Neuf/Ancien'>Neuf/Ancien</option>";
                                        break;
                                        case "Neuf/Ancien":
                                            $option3="<option value='Neuf'>Neuf</option>
                                            <option value='Ancien'>Ancien</option>";
                                        break;
                                    }
                                ?>

                                <select class="mdb-select md-form form-control" id="etat" name="etat" title="Etat">
                                    <option value="{{ $client->etat }}" selected>{{ $client->etat }}</option>
                                    <?php echo $option3; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="secteur">Secteur</label>
                                <?php
                                    $option4="<option value='Tel'>Tel</option>
                                    <option value='Sms'>Sms</option>
                                    <option value='Mail'>Mail</option>
                                    <option value='Direct'>Direct</option>";
                                    switch ($client->contact){
                                        case "Tel":
                                            $option4="<option value='Sms'>Sms</option>
                                            <option value='Mail'>Mail</option>
                                            <option value='Direct'>Direct</option>";
                                        break;
                                        case "Sms":
                                            $option4="<option value='Tel'>Tel</option>
                                            <option value='Mail'>Mail</option>
                                            <option value='Direct'>Direct</option>";
                                        break;
                                        case "Mail":
                                            $option4="<option value='Tel'>Tel</option>
                                            <option value='Sms'>Sms</option>
                                            <option value='Direct'>Direct</option>";
                                        break;
                                        case "Direct":
                                            $option4="<option value='Tel'>Tel</option>
                                            <option value='Sms'>Sms</option>
                                            <option value='Mail'>Mail</option>";
                                        break;
                                    }
                                ?> 
                                <input id="secteur" value="{{ $client->secteur }}" type="text" class="form-control" name="secteur">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="contact">Prise de contact</label>
                                <select class="mdb-select md-form form-control" id="contact" name="contact" title="Prise de contact">
                                    <option value="{{ $client->contact }}" selected>{{ $client->contact }}</option>
                                    <?php echo $option4; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="suivi">Suivi</label>
                                <?php
                                    $option5="<option value='A rappeler'>A rappeler</option>
                                    <option value='A relancer'>A relancer</option>
                                    <option value='Contrat/compromis signé'>Contrat/compromis signé</option>
                                    <option value='Acte signé'>Acte signé</option>";
                                    switch ($client->suivi){
                                        case "A rappeler":
                                            $option5="<option value='A relancer'>A relancer</option>
                                            <option value='Contrat/compromis signé'>Contrat/compromis signé</option>
                                            <option value='Acte signé'>Acte signé</option>";
                                        break;
                                        case "A relancer":
                                            $option5="<option value='A rappeler'>A rappeler</option>
                                            <option value='Contrat/compromis signé'>Contrat/compromis signé</option>
                                            <option value='Acte signé'>Acte signé</option>";
                                        break;
                                        case "Contrat/compromis signé":
                                            $option5="<option value='A relancer'>A relancer</option>
                                            <option value='A rappeler'>A rappeler</option>
                                            <option value='Acte signé'>Acte signé</option>";
                                        break;
                                        case "Acte signé":
                                            $option5="<option value='A relancer'>A relancer</option>
                                            <option value='Contrat/compromis signé'>A rappeler</option>
                                            <option value='Contrat/compromis signé'>Contrat/compromis signé</option>";
                                        break;
                                    }
                                ?>   

                                <select class="mdb-select md-form form-control" id="suivi" name="suivi" title="Suivi">
                                    <option value="{{ $client->suivi }}" selected>{{ $client->suivi }}</option>
                                    <?php echo $option5; ?>
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
                                <?php
                                    $option6="<option value='Oui'>Oui</option>
                                    <option value='Non'>Non</option>";
                                    switch ($client->actif){
                                        case "Non" :
                                            $option6="<option value='Oui'>Oui</option>";
                                            break;
                                        case "Oui" :
                                            $option6="<option value='Non'>Non</option>";
                                            break;
                                    }
                                ?>
                                <select class="mdb-select md-form form-control" id="actif" name="actif" title="Actif">
                                    <option value="{{ $client->actif }}" selected>{{ $client->actif }}</option>
                                    <?php echo $option6; ?>
                                </select>
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