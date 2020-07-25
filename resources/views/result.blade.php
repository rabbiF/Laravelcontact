@extends('layouts.app')
@section('content')

@if(count($result))
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9 col-lg-10">
        @include('clients.partials.info')
            <div class="card card-default">
                <div class="card-header bg-info text-white">Résultat(s) Trouvé(s)</div>
                <div class="card-body card-body table-responsive-lg table-responsive-md table-responsive-sm">
                    <div class="form-inline pb-2 align-items-start">
                        <div class="pl-0 pb-2 pb-xl-2 col-md-12 col-lg-6 col-xl-6">
                            <form action="{{ route('client.search') }}" method="get" class="form-inline pb-2">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" name="q" placeholder="Rechercher*" required>
                                </div>

                                <div class="form-group mb-0">
                                    <button class="btn btn-success" type="submit">
                                        Rechercher
                                    </button>
                                </div>
                            </form>

                            <form action="{{ route('client.search') }}" method="get" class="form-inline pb-2">
                                <div class="form-group mb-0">
                                    <select class="selectpicker" multiple title="Rechercher par bien..." name="bien" required>
                                        <option value="T1">T1</option>
                                        <option value="T2">T2</option>
                                        <option value="T3">T3</option>
                                        <option value="T4">T4</option>
                                        <option value="T5">T5</option>
                                        <option value="Villas">Villas</option>
                                        <option value="Terrain">Terrain</option>
                                        <option value="Locaux Commmerciaux">Locaux Commmerciaux</option>
                                        <option value="Bureaux">Bureaux</option>
                                        <option value="Maison">Maison</option>
                                    </select>
                                </div>

                                <div class="form-group mb-0">
                                    <button class="btn btn-success" type="submit">
                                        Rechercher
                                    </button>
                                </div>
                            </form>
                            <em>* Recherche par email, tél., nom, prénom</em>
                        </div>

                        <div class="pr-0 pl-0 pb-2 pb-xl-0 col-md-12 col-lg-6 col-xl-6 text-lg-right text-left">
                            <div>
                                <?php
                                    $tabUrl = parse_url ( $_SERVER [ 'REQUEST_URI' ] ) ;
                                    $listparam = explode ( "bien=" , $tabUrl [ 'query' ] ) ;
                                     
                                    if(isset($listparam)){
                                        unset($listparam[0]);
                                        $listparam = array_values($listparam);
                                        $listparam = str_replace("bien", "", $listparam);
                                        $listparam = implode("bien", $listparam);
                                        $listparam = str_replace("&", "", $listparam);
                                    }else{
                                        $listparam="";
                                    }
                                ?>
                                <span><a href="{{ route('client.download', 'bien='.$listparam.'&tel_search='.request('q')) }}" class="btn btn-success">Export Télephones</a></span>
                                <span><a href="{{ route('client.download', 'bien='.$listparam.'&mail_search='.request('q')) }}" class="btn btn-success">Export Emails</a></span>
                            </div>
                        </div>
                    </div>
                    <table id="customer_data" class="table table-bordered">
                        <thead class="thead-light"> 
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Tél.</th>
                            <th>Email</th>
                            <th>Bien</th>
                            <th colspan="3" class="text-center">Actions</th>
                        </thead>
                        <tbody id="accordionExample">
                            @foreach($result as $c)
                            <tr id="heading{{ $c->id }}">
                                <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}" >{{ $c->name }}</td>
                                <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">{{ $c->firstname }}</td>
                                <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">{{ $c->phone }} </td>
                                <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">{{ $c->email }}</td>
                                <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">{{ $c->type_de_bien }}</td>
                                <td colspan="3" class="text-center">
                                    <a class="btn btn-info btn-sm" href="{{ route('client.show', ['client' => $c->id]) }}">details</a>
                                    <a class="btn btn-warning btn-sm" href="{{ route('client.edit', ['client' => $c->id]) }}">editer</a>
                                    <a id="supprimer" class="btn btn-danger btn-sm" href="{{ route('client.delete', ['client' => $c->id]) }}">supprimer</a>
                                </td>
                            </tr>
                            <tr class="collapse" id="collapse{{ $c->id }}" aria-labelledby="heading{{ $c->id }}" data-parent="#accordionExample">
                                <td colspan="6">                                    
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="date_contact">Date de contact</label>
                                                <input id="date_contact" value="{{ \Carbon\Carbon::parse($c->date_contact)->format('d/m/Y') }}" disabled type="text" class="form-control" name="date_contact">
                                            </div> 
                                        </div>

                                        <div class="form-group">
                                            <label for="commentaires">Commentaires</label>
                                            <textarea id="commentaires" class="form-control" disabled name="commentaires" cols="5" rows="5">{{ $c->commentaires }}</textarea>
                                        </div>
                                    </form>                                        
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <a href="/home" class="btn btn-primary btn-sm">Retour</a>
                </div>
            </div>
            <span>&nbsp;</span>
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9 col-lg-10">
            <div class="card card-default">
                <div class="card-header bg-info text-white">Aucun résultats</div>

                <div class="card-body card-body table-responsive-lg table-responsive-md table-responsive-sm">

                    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Retour</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('script')
$(function () {
    $('select').selectpicker();
});
@endsection
