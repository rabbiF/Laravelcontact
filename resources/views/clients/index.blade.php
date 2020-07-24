@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9 col-lg-10">
        @include('clients.partials.info')
            <div class="card card-default">
                <div class="card-header bg-info text-white">Liste des clients</div>
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
            <span>&nbsp;</span> {{ $clients->links() }}
        </div>
    </div>
</div>
@include('clients.add')
@endsection
@section('script')
$(function () {
    $('select').selectpicker();
});
@endsection
