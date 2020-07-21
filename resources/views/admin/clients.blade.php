@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @include('admin.menu')
        <div class="col-md-9 col-lg-10">        
            <div class="card card-default">
                <div class="card-header bg-info text-white">Dashboard - Admin</div>
                <div class="card-body card-body table-responsive-lg table-responsive-md table-responsive-sm">                                         
                    <div class="form-inline pb-4">
                        <span><a href="{{ url('/exports') }}" class="btn btn-success">Export Clients</a></span>
                    </div>    
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Tél.</th>
                                <th>Email.</th>
                                <th>Nom.</th>
                                <th>Prénom.</th>
                                <th>Type de Bien</th>
                                <th>Email du mandataire</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($clientsAll) > 0) @foreach($clientsAll as $c)
                                <tr>
                                    <td>{{ $c->phone }}</td>
                                    <td>{{ $c->email }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->firstname }}</td>
                                    <td>{{ $c->type_de_bien }}</td>
                                    <td>{{ $c->email_mandataires }}</td>
                                </tr>
                            @endforeach @else
                            <p class="text-center bg-info text-white">
                                Aucun client enregistré
                            </p>
                            @endif                              
                        </tbody>
                    </table>
                </div>
            </div>
            <span>&nbsp;</span> {{ $clientsAll->links() }}
        </div>
    </div>
</div>
@endsection 
