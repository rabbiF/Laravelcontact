<div class="modal fade" id="addClient" tabindex="-1" role="dialog" aria-labelledby="addclient" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClient">Nouveau client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('clients') }}">
                    @csrf
                    <div class="form-group row col-md-9 col-lg-10">
                        <label for="date_contact" class="col-4 col-sm-5 col-md-6 col-lg-4 col-form-label px-0">Date de contact <span class="text-danger">*</span></label> 
                        <div class="col-6 col-sm-6 col-md-6">
                            <input id="date_contact" type="date" name="date_contact" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <input id="name" placeholder="Nom *" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group col-md-3">
                            <input id="firstname" placeholder="Prénom" type="text" class="form-control" name="firstname">
                        </div>
                        <div class="form-group col-md-6">
                            <input id="email" placeholder="Email" type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group col-md2 col-lg-4">
                            <input id="tel" placeholder="N° Téléphone" type="text" class="form-control" name="phone">
                        </div>
                        <div class="form-group col-md-4">
                            <input id="contact_origine" placeholder="Origine Contact" type="text" class="form-control" name="contact_origine">
                        </div>
                        <div class="form-group col-md-4">
                            <select class="mdb-select md-form form-control" id="projet" name="projet" title="Projet">
                                <?=$metrics->staticSelect("Projet") ?> 
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-lg-6">
                            <select class="mdb-select md-form form-control" id="type_de_bien" name="type_de_bien[]" multiple title="Type de Bien">
                                <?=($metrics->staticBien())['optionBien'] ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <select class="mdb-select md-form form-control" id="etat" name="etat" title="Etat">
                                <?=$metrics->staticSelect("Etat") ?> 
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <input id="secteur" placeholder="Secteur" type="text" class="form-control" name="secteur">
                            <div class="mt-3">
                                <?=$metrics->staticOptionColor() ?>
                            </div>
                        </div>                        
                        <div class="form-group col-md-4">
                            <select class="mdb-select md-form form-control" id="contact" name="contact" title="Prise de contact">
                                <?=$metrics->staticSelect("Contact") ?> 
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <select class="mdb-select md-form form-control" id="suivi" name="suivi" title="Suivi">
                                <?=$metrics->staticSelect("Suivi") ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <input id="budget" placeholder="Budget" type="text" class="form-control" name="budget">
                        </div>
                        <div class="form-group col-md-3 col-lg-3">
                            <input id="client_nego" placeholder="Client Négo." type="text" class="form-control" name="client_nego">
                        </div>
                        <div class="form-group col-md-4">
                            <select class="mdb-select md-form form-control" id="actif" name="actif" title="Actif">
                                <?=$metrics->staticSelect("Actif") ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="commentaires">Commentaires</label>
                        <textarea id="commentaires" class="form-control" name="commentaires" cols="5" rows="5"></textarea>
                    </div>

                    <p><em>Les champs marqués d'une * sont obligatoire !</em></p>

                    <button type="submit" class="btn btn-success btn-sm">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
