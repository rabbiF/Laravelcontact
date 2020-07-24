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
                                <label for="date_contact">Date de contact</label>
                                <input id="date_contact" value="{{ $client->date_contact }}" type="date" class="form-control" name="date_contact">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="name">Nom</label>                            
                                <input id="name" value="{{ $client->name }}" type="text" class="form-control" name="name">                         
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
                                <label for="tel">Tél.</label>
                                <input id="tel" value="{{ $client->phone }}" type="text" class="form-control" name="phone">
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
                                <select class="mdb-select md-form form-control" id="projet" name="projet">
                                    <option value="" disabled>Projet</option>
                                    <option value="{{ $client->projet }}" selected>{{ $client->projet }}</option>
                                    <?php echo $option1; ?>                            
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-lg-2">
                                <label for="type">Type de Bien</label>
                                <?php
                                    $option2="<option value='T1'>T1</option>
                                    <option value='T2'>T2</option>
                                    <option value='T3'>T3</option>
                                    <option value='T4'>T4</option>
                                    <option value='T5'>T5</option>
                                    <option value='Villas'>Villas</option>
                                    <option value='Terrain'>Terrain</option>
                                    <option value='Locaux Commmerciaux'>Locaux Commmerciaux</option>
                                    <option value='Bureaux'>Bureaux</option>
                                    <option value='Maison'>Maison</option>";

                                    switch ($client->type_de_bien){
                                        case "T1":
                                            $option2="<option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='Villas'>Villas</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Locaux Commmerciaux'>Locaux Commmerciaux</option>
                                            <option value='Bureaux'>Bureaux</option>
                                            <option value='Maison'>Maison</option>";
                                        break;
                                        case "T2":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='Villas'>Villas</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Locaux Commmerciaux'>Locaux Commmerciaux</option>
                                            <option value='Bureaux'>Bureaux</option>
                                            <option value='Maison'>Maison</option>";                                        
                                        break;
                                        case "T3":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='Villas'>Villas</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Locaux Commmerciaux'>Locaux Commmerciaux</option>
                                            <option value='Bureaux'>Bureaux</option>
                                            <option value='Maison'>Maison</option>";
                                        break;
                                        case "T4":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T5'>T5</option>
                                            <option value='Villas'>Villas</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Locaux Commmerciaux'>Locaux Commmerciaux</option>
                                            <option value='Bureaux'>Bureaux</option>
                                            <option value='Maison'>Maison</option>";
                                        break;
                                        case "T5":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='Villas'>Villas</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Locaux Commmerciaux'>Locaux Commmerciaux</option>
                                            <option value='Bureaux'>Bureaux</option>
                                            <option value='Maison'>Maison</option>";
                                        break;
                                        case "Villas":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Locaux Commmerciaux'>Locaux Commmerciaux</option>
                                            <option value='Bureaux'>Bureaux</option>
                                            <option value='Maison'>Maison</option>";
                                        break;
                                        case "Terrain":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='Villas'>Villas</option>
                                            <option value='Locaux Commmerciaux'>Locaux Commmerciaux</option>
                                            <option value='Bureaux'>Bureaux</option>
                                            <option value='Maison'>Maison</option>";
                                        break;
                                        case "Locaux Commmerciaux":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='Villas'>Villas</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Bureaux'>Bureaux</option>
                                            <option value='Maison'>Maison</option>";
                                        break;
                                        case "Bureaux":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='Villas'>Villas</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Locaux Commmerciaux'>Locaux Commmerciaux</option>
                                            <option value='Maison'>Maison</option>";
                                        break;
                                        case "Maison":
                                            $option2="<option value='T1'>T1</option>
                                            <option value='T2'>T2</option>
                                            <option value='T3'>T3</option>
                                            <option value='T4'>T4</option>
                                            <option value='T5'>T5</option>
                                            <option value='Villas'>Villas</option>
                                            <option value='Terrain'>Terrain</option>
                                            <option value='Locaux Commmerciaux'>Locaux Commmerciaux</option>
                                            <option value='Bureaux'>Bureaux</option>";
                                        break;
                                    }
                                ?>

                                <select class="mdb-select md-form form-control" id="type_de_bien" name="type_de_bien">
                                    <option value="" disabled>Type de Bien</option>
                                    <option value="{{ $client->type_de_bien }}">{{ $client->type_de_bien }}</option>
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

                                <select class="mdb-select md-form form-control" id="etat" name="etat">
                                    <option value="" disabled>Etat</option>
                                    <option value="{{ $client->etat }}">{{ $client->etat }}</option>
                                    <?php echo $option3; ?>                                    
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="typologie">Typologie</label>
                                <input id="typologie" value="{{ $client->typologie }}" type="text" class="form-control" name="typologie">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="secteur">Secteur</label>
                                <input id="secteur" value="{{ $client->secteur }}" type="text" class="form-control" name="secteur">
                            </div>                            
                            <div class="form-group col-md-3">
                                <label for="contact">Prise de contact</label>
                                <input id="contact" value="{{ $client->contact }}" type="text" class="form-control" name="contact">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="suivi">Suivi</label>
                                <?php
                                    $option4="<option value='A rappeler'>A rappeler</option>
                                    <option value='A relancer'>A relancer</option>
                                    <option value='Contrat/compromis signé'>Contrat/compromis signé</option>
                                    <option value='Acte signé'>Acte signé</option>";
                                    switch ($client->suivi){
                                        case "A rappeler":
                                            $option4="<option value='A relancer'>A relancer</option>
                                            <option value='Contrat/compromis signé'>Contrat/compromis signé</option>
                                            <option value='Acte signé'>Acte signé</option>";
                                        break;
                                        case "A relancer":
                                            $option4="<option value='A rappeler'>A rappeler</option>
                                            <option value='Contrat/compromis signé'>Contrat/compromis signé</option>
                                            <option value='Acte signé'>Acte signé</option>";
                                        break;
                                        case "Contrat/compromis signé":
                                            $option4="<option value='A relancer'>A relancer</option>
                                            <option value='A rappeler'>A rappeler</option>
                                            <option value='Acte signé'>Acte signé</option>";
                                        break;
                                        case "Acte signé":
                                            $option4="<option value='A relancer'>A relancer</option>
                                            <option value='Contrat/compromis signé'>A rappeler</option>
                                            <option value='Contrat/compromis signé'>Contrat/compromis signé</option>";
                                        break;
                                    }
                                ?>   

                                <select class="mdb-select md-form form-control" id="suivi" name="suivi">
                                    <option value="" disabled>Suivi</option>
                                    <option value="{{ $client->suivi }}">{{ $client->suivi }}</option>
                                    <?php echo $option4; ?>                               
                                </select>                            
                            </div>
                            <div class="form-group col-md-2">
                                <label for="budget">Budget</label>
                                <input id="budget" value="{{ $client->budget }}" type="text" class="form-control" name="budget">
                            </div>
                            <div class="form-group col-md-4 col-lg-3">
                                <label for="propositions">Propositions Clients</label>
                                <input id="propositions" value="{{ $client->propositions }}" type="text" class="form-control" name="propositions">
                            </div>
                            <div class="form-group col-md-4 col-lg-3">
                                <label for="visites">Visites Effectuées</label>
                                <input id="visites" value="{{ $client->visites }}" type="text" class="form-control" name="visites">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="client_nego">Client Négo.</label>
                                <input id="client_nego" value="{{ $client->client_nego }}" type="text" class="form-control" name="client_nego">
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