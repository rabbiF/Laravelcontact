@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @include('admin.menu')
        <div class="col-md-9 col-lg-10">
        @include('admin.partials.info')
            <div class="card card-default">
                <div class="card-header bg-info text-white">Liste des utilisateurs</div>
                <div class="card-body card-body table-responsive-lg table-responsive-md table-responsive-sm">                    
                    <div class="form-inline pb-2 align-items-start">
                        <div class="pl-0 pb-2 pb-xl-2 col-md-12 col-lg-6 col-xl-6">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser" data-whatever="@getbootstrap">
                                Nouveau
                            </button>                        
                        </div>
                    </div>                    
                    @include('admin.table')
                </div>
            </div>
            <span>&nbsp;</span> {{ $user->links() }}
        </div>
    </div>
</div>
@include('admin.add')
@endsection 