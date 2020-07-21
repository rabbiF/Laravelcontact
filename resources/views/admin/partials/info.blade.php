@if(Session::has('success')) @alert(['type' => 'info'])    
    <strong>Info!</strong> {{ Session::get('success') }} @endalert    
@endif

@if($errors)
    @foreach($errors->all() as $e)
        <span class="text-danger">
            <strong>Il faut remplir tout les champs marqués d'une * !</strong> 
        </span>
    @endforeach
@endif
