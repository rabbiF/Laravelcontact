@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-10">
            @include('biens.partials.info')
            <div class="card card-default">
                <div class="card-header bg-info text-white">Edition bien : {{ $bien->id }} </div>
                <div class="card-body">
                    <form action="{{ route('bien.update', ['bien' => $bien->id]) }}" method="POST">
                        @csrf
                        <div class="form-bien">
                            <label for="name" class="col-form-label">Nom:</label>
                            <input value="{{ $bien->name }}" type="text" class="form-control" id="name" name="name">
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection