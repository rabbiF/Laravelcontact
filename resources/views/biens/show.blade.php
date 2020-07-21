@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
    @include('layouts.menu')
        <div class="col-md-10">
            <div class="card card-default">
                <div class="card-header bg-info text-white">Detail bien : {{ $bien->id }} </div>
                <div class="card-body">
                    <form>
                        <div class="form-bien">
                            <label for="name" class="col-form-label">Nom:</label>
                            <input value="{{ $bien->name }}" type="text" class="form-control" disabled="disabled" id="name">
                        </div>
                        <a href="/home" class="btn btn-default btn-sm">Retour</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection