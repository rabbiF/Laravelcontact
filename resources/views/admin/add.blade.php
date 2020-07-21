<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUser" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUser">Nouveau utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin') }}">
                    @csrf                    

                    <div class="form-row">
                        <div class="form-group col-md-3">                          
                            <input id="name" placeholder="Nom et Prénom" type="text" class="form-control" name="name" required>                         
                        </div>                        
                        <div class="form-group col-md-6">
                            <input id="email" placeholder="Email" type="text" class="form-control" name="email" required>
                        </div>
                        <div class="form-group col-md2 col-lg-4">
                            <input id="password" placeholder="Mot de Passe" ype="password" class="form-control" name="password" required>
                        </div>                        
                        <div class="form-group col-md-4">
                            <select class="mdb-select md-form form-control" id="isAdmin" name="isAdmin" required>
                                <option value="" disabled selected>Rôle</option>
                                <option value="1">Admin</option>
                                <option value="0">User</option>                                                               
                            </select>
                        </div>                                                                           
                    </div> 

                    <button type="submit" class="btn btn-success btn-sm">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>