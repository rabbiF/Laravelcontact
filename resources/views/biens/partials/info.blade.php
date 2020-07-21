@if(Session::has('success')) @alert(['type' => 'info'])
<strong>Info!</strong> {{ Session::get('success') }} @endalert @endif @if($errors->has('name')) @alert(['type' => 'danger'])
<strong>Erreur!</strong> {{ $errors->first('name') }} @endalert @endif