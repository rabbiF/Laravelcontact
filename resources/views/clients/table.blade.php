<table id="customer_data" class="table table-bordered">
    <thead class="thead-light">        
        <th>Tél.</th>
        <th>Email</th>
        <th>Bien</th>
        <th colspan="3" class="text-center">Actions</th>
    </thead>
    <tbody id="accordionExample"> 
        @if(count($clients) > 0) @foreach($clients as $c)
        <tr>            
            <td id="heading{{ $c->id }}">  
                <button class="btn btn-link collapsed  py-0" type="button" data-toggle="collapse" data-target="#collapseExample{{ $c->id }}" aria-expanded="false" aria-controls="collapseExample{{ $c->id }}">
                    {{ $c->phone }}
                </button>

                <div class="collapse" id="collapseExample{{ $c->id }}" aria-labelledby="heading{{ $c->id }}" data-parent="#accordionExample">
                    <div class="card card-body">
                    <form>
                    <div class="form-row">
                            <div class="form-group col-md-12 col-lg-7 col-xl-4">
                                <label for="date_contact">Date de contact</label>
                                <input id="date_contact" value="{{ \Carbon\Carbon::parse($c->date_contact)->format('d/m/Y') }}" disabled type="text" class="form-control" name="date_contact">
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xl-8">
                                <label for="fullname">Nom et Prénom</label>                            
                                <input id="fullname" value="{{ $c->name }} {{ $c->firstname }}" disabled type="text" class="form-control" name="name">                         
                            </div> 
                            <div class="form-group col-md-12 col-lg-7 col-xl-4">
                                <label for="contact_origine">Origine Contact</label>
                                <input id="contact_origine"  value="{{ $c->contact_origine }}" disabled type="text" class="form-control" name="contact_origine">
                            </div>
                            <div class="form-group col-md-12 col-lg-7 col-xl-4">
                                <label for="projet">Projet</label>
                                <input id="projet" value="{{ $c->projet }}" disabled type="text" class="form-control" name="projet">
                            </div>                                                          
                            <div class="form-group col-md-12 col-lg-7 col-xl-4">
                                <label for="etat">Etat</label>
                                <input id="etat" value="{{ $c->etat }}" disabled type="text" class="form-control" name="etat">
                            </div>
                            <div class="form-group col-md-12 col-lg-7 col-xl-4">
                                <label for="typologie">Typologie</label>
                                <input id="typologie" value="{{ $c->typologie }}" disabled type="text" class="form-control" name="typologie">
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xl-8">
                                <label for="secteur">Secteur</label>
                                <input id="secteur" value="{{ $c->secteur }}" disabled type="text" class="form-control" name="secteur">
                            </div>                            
                            <div class="form-group col-md-12 col-lg-7 col-xl-5">
                                <label for="contact">Prise de contact</label>
                                <input id="contact" value="{{ $c->contact }}" disabled type="text" class="form-control" name="contact">
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xl-7">
                                <label for="suivi">Suivi</label>
                                <input id="suivi" value="{{ $c->suivi }}" disabled type="text" class="form-control" name="suivi">
                            </div>
                            <div class="form-group col-md-12 col-lg-5 col-xl-5">
                                <label for="budget">Budget</label>
                                <input id="budget" value="{{ $c->budget }}" disabled type="text" class="form-control" name="budget">
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xl-7">
                                <label for="propositions">Propositions Clients</label>
                                <input id="propositions" value="{{ $c->propositions }}" disabled type="text" class="form-control" name="propositions">
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xl-5">
                                <label for="visites">Visites Effectuées</label>
                                <input id="visites" value="{{ $c->visites }}" disabled type="text" class="form-control" name="visites">
                            </div>
                            <div class="form-group col-md-12 col-xl-7">
                                <label for="client_nego">Client Négo.</label>
                                <input id="client_nego" value="{{ $c->client_nego }}" disabled type="text" class="form-control" name="client_nego">
                            </div>                                                     
                        </div>                        

                        <div class="form-group">
                            <label for="commentaires">Commentaires</label>
                            <textarea id="commentaires" class="form-control" disabled name="commentaires" cols="5" rows="5">{{ $c->commentaires }}</textarea>                            
                        </div>                        
                    </form>
                    </div>
                </div>  
            </td>
            <th>{{ $c->email }}</th>
            <th>{{ $c->type_de_bien }}</th>               
            <td colspan="3" class="text-center">
                <a class="btn btn-info btn-sm" href="{{ route('client.show', ['client' => $c->id]) }}">details</a>
                <a class="btn btn-warning btn-sm" href="{{ route('client.edit', ['client' => $c->id]) }}">editer</a>
                <a id="supprimer" class="btn btn-danger btn-sm" href="{{ route('client.delete', ['client' => $c->id]) }}">supprimer</a>
            </td>
        </tr>
        @endforeach @else
        <p class="text-center bg-info text-white">
            Aucun client enregistré
        </p>
        @endif
    </tbody>
</table>