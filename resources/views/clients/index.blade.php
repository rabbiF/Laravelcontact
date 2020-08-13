@extends('layouts.app')
@section('content')
@inject('metrics', ' App\Http\Controllers\ClientController')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9 col-lg-12">
        @include('clients.partials.info')
            <div class="card card-default">
                <div class="card-header bg-info text-white">Liste des clients</div>
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
                                                <?=$metrics->staticSelect('Etat','Neuf,Ancien')?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-0 pl-0 col-md-3">
                                            <select class="selectpicker" multiple title="Actif" name="actif">
                                                <?=$metrics->staticSelect('Actif', 'Oui,Non')?>
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
                                <span><a href="{{ route('client.download', 'tel_search='.request('q')) }}" class="btn btn-success">Export Télephones</a></span>
                                <span><a href="{{ route('client.download', 'mail_search='.request('q')) }}" class="btn btn-success">Export Emails</a></span>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addClient" data-whatever="@getbootstrap">
                                    Nouveau
                                </button>
                            </div>    
                        </div>
                    </div>
                    @include('clients.table')
                </div>
            </div>
            <span>&nbsp;</span>
        </div>
    </div>
</div>
@include('clients.add')
@endsection
@section('script')
$(function () {
    $('select').selectpicker();
    $('a#supprimer').confirm({
        title: 'Confirmation',
        content: 'Voulez-vous vraiment supprimer?', 
        buttons: { 
            Oui: {
                btnClass: 'btn btn-danger btn-sm',
                action: function(){ 
                location.href = this.$target.attr('href'); 
            }},
            Non:{ 
                btnClass: 'btn btn-default',
                action: function(){
                    $.alert('Annulation');
                }
            }
        } 
    });
});
@endsection