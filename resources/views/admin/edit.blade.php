@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
    @include('admin.menu')
        <div class="col-md-9 col-lg-10">
            @include('admin.partials.info')
            <div class="card card-default">
                <div class="card-header bg-info text-white">Editer utilisateur : {{ $user->id }} </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.update', ['user' => $user->id]) }}">
                        @csrf
                        <div class="form-row">                            
                            <div class="form-group col-md-6">       
                                <label for="name">Nom et Prénom</label>                    
                                <input id="name" value="{{ $user->name }}" type="text" class="form-control" name="name">                         
                            </div>                        
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>  
                                <input id="email" value="{{ $user->email }}" type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group col-md2 col-lg-4">
                                <label for="password">Mot de Passe</label>
                                <input id="password" value="{{ $user->password }}" type="password" class="form-control" name="password">
                            </div>                        
                            <div class="form-group col-md-4">
                                <label for="isAdmin">Rôle</label>
                                <?php                                     
                                    if(($user->isAdmin) == 1){                                       
                                        $optionSelected = "<option value='1' selected>Admin</option>";
                                        $option = "<option value='0'>User</option>";
                                    }else{                                       
                                        $optionSelected = "<option value='0' selected>User</option>";
                                        $option = "<option value='1'>Admin</option>";
                                    }                                
                                ?>
                                
                                <select class="mdb-select md-form form-control" id="isAdmin" name="isAdmin">
                                    <option value="" disabled>Rôle</option>
                                    <?php 
                                    echo $optionSelected;
                                    echo $option;
                                    ?>                                                                                           
                                </select>
                            </div>                                                                           
                        </div>                      
   
                        <button type="submit" class="btn btn-success btn-sm">Sauvegarder</button>

                        <a href="/admin" class="btn btn-primary btn-sm">Retour</a>                 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection