@extends('layouts.app')
@section('content')
@inject('metrics', ' App\Http\Controllers\ClientController')
@if(count($result))
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9 col-lg-12">
        @include('clients.partials.info')
            <div class="card card-default">
                <div class="card-header bg-info text-white">Résultat(s) Trouvé(s)</div>
                <div class="card-body card-body table-responsive-lg table-responsive-md table-responsive-sm table-responsive-xl">
                    <div class="form-inline pb-2 align-items-start">
                        <div class="form-inline pl-0 pb-2 pb-xl-2 col-md-12 col-lg-6 col-xl-6">
                            <div class="form-inline pb-2 pr-2">
                                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Filtres
                                </button>
                            </div>
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

                            <em>* Recherche par email, tél., nom, prénom</em>

                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <form action="{{ route('client.search') }}" method="get" class="form-inline pb-2">
                                        <div class="form-group mb-2 pl-0">
                                            <select class="selectpicker" multiple title="Bien..." name="bien" required>
                                                <?=($metrics->staticBien())['optionBien'] ?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-2  pl-0 pl-sm-2 col-sm-4 col-md-4">
                                            <select class="selectpicker" multiple title="Etat..." name="etat">
                                                <?=$metrics->staticSelect('Etat', 'Neuf,Ancien')?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-0 pl-0 col-md-3">
                                            <select class="selectpicker" title="Actif" name="actif">
                                                <?=$metrics->staticSelect('Actif', 'Oui')?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-0 pt-2 pt-md-0">
                                            <button class="btn btn-success" type="submit">
                                                Appliquer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

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

                                        $listparam1 = $listparam2 = "";
                                      
                                        if(strpos($listparam,"actif=")){
                                            $listparam2 = explode ( "actif=" , $listparam);
                                            unset($listparam2[0]);
                                            $listparam2 = array_values($listparam2); 
                                            $listparam2 = str_replace("actif=", "", $listparam2);
                                            $listparam2 = implode("actif", $listparam2);
                                            $listparam2 = str_replace("&", "", $listparam2); 

                                            $searchArray = ["actif="];
                                            $listparam = str_replace($searchArray, "", $listparam);
                                            $listparam = str_replace($listparam2, "", $listparam);

                                            $listparam1 = explode ( "etat=" , $listparam);
                                            unset($listparam1[0]);
                                            $listparam1 = array_values($listparam1); 
                                            $listparam1 = str_replace("etat=", "", $listparam1);
                                            $listparam1 = implode("etat", $listparam1);
                                            $listparam1 = str_replace("&", "", $listparam1);

                                            $searchArray = ["etat="];
                                            $listparam = str_replace($searchArray, "", $listparam);
                                            $listparam = str_replace($listparam1, "", $listparam);
                                        }else{
                                            $listparam1 = explode ( "etat=" , $listparam);
                                            unset($listparam1[0]);
                                            $listparam1 = array_values($listparam1); 
                                            $listparam1 = str_replace("etat=", "", $listparam1);
                                            $listparam1 = implode("etat", $listparam1);
                                            $listparam1 = str_replace("&", "", $listparam1); 

                                            $searchArray = ["etat="];
                                            $listparam = str_replace($searchArray, "", $listparam);
                                            $listparam = str_replace($listparam1, "", $listparam);
                                            
                                            $listparam2 = explode ("actif=" , $listparam1);
                                            unset($listparam2[0]);
                                            $listparam2 = array_values($listparam2); 
                                            $listparam2 = str_replace("actif=", "", $listparam2);
                                            $listparam2 = implode("actif", $listparam2);
                                            $listparam2 = str_replace("&", "", $listparam2);
                                            
                                            $searchArray = ["actif="];
                                            $listparam1 = str_replace($searchArray, "", $listparam1);
                                            $listparam1 = str_replace($listparam2, "", $listparam1);

                                            $searchArray = ["actif="];
                                            $listparam = str_replace($searchArray, "", $listparam);
                                            $listparam = str_replace($listparam2, "", $listparam);
                                        }
                                    }else{
                                        $listparam="";
                                        $listparam1="";
                                    }
                                ?>
                                <span><a href="{{ route('client.download', 'bien='.$listparam.'&etat='.$listparam1.'&actif='.$listparam2.'&tel_search='.request('q')) }}" class="btn btn-success">Export Télephones</a></span>
                                <span><a href="{{ route('client.download', 'bien='.$listparam.'&etat='.$listparam1.'&actif='.$listparam2.'&mail_search='.request('q')) }}" class="btn btn-success">Export Emails</a></span>                            </div>    
                        </div>
                    </div> 
                    <table id="customer_data" class="table table-bordered">
                        <thead class="thead-light"> 
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Tél.</th>
                        <th>Bien</th>
                        <th>Option</th>
                        <th>Etat</th>
                        <th>Actif</th>
                            <th colspan="3" class="text-center">Actions</th>
                        </thead>
                        <tbody id="accordionExample">
                            @foreach($result as $c)
                            <?php 
                                (isset($c->options_color)) ? $color = "text-white" : $color = "";
                            ?>
                            <tr id="heading{{ $c->id }}">
                                <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}" >
                                    <span class="text-truncate text-break w-08-rem d-inline-block pl-0 pr-0">{{ $c->name }}</span>
                                </td>
                                <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">
                                <span class="text-truncate text-break w-08-rem d-inline-block pl-0 pr-0">{{ $c->firstname }}</span>
                                </td>
                                <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">
                                    <span class="text-truncate text-break w-06-rem d-inline-block pl-0 pr-0">{{ $c->phone }}</span>
                                </td>
                                <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">
                                    <span class="text-truncate text-break w-08-rem d-inline-block pl-0 pr-0">{{ $c->type_de_bien }}</span>
                                    <div class="mt-2">
                                        <?=($metrics->staticBien($c->type_de_bien))['optionColor'] ?>
                                    </div>
                                </td>
                                <td class="bg-{{$c->options_color}} <?=$color ?>" data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">
                                    <span class="text-truncate text-break w-08-rem d-inline-block pl-0 pr-0">{{ $c->options_secteur }}</span>
                                </td>
                                <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">
                                    <span class="text-truncate text-break w-05-rem d-inline-block pl-0 pr-0">{{ $c->etat }}</span>
                                </td>
                                <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">
                                    <span class="text-truncate text-break w-03-rem d-inline-block pl-0 pr-0">{{ $c->actif }}</span>
                                </td>
                                <td colspan="2" class="text-center">
                                    <div>
                                        <a class="btn btn-info btn-sm" href="{{ route('client.show', ['client' => $c->id]) }}">details</a>
                                    </div>
                                    <div class="mt-2">
                                        <a class="btn btn-warning btn-sm" href="{{ route('client.edit', ['client' => $c->id]) }}">editer</a>
                                    </div>
                                    <div class="mt-2">
                                        <a id="supprimer" class="btn btn-danger btn-sm" href="{{ route('client.delete', ['client' => $c->id]) }}">supprimer</a>
                                    </div>
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
                                            <div class="form-group col-md-4">
                                                <label for="email">Email</label>
                                                <input id="email" value="{{ $c->email }}" disabled type="text" class="form-control" name="email">
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
