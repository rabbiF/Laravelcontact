<table id="customer_data" class="table table-bordered">
    <thead class="thead-light"> 
        <th>Nom</th>
        <th>Prénom</th>
        <th>Tél.</th>
        <th>Email</th>
        <th>Bien</th>
        <th colspan="3" class="text-center">Actions</th>
    </thead>
    <tbody id="accordionExample"> 
        @if(count($clients) > 0) @foreach($clients as $c)
        <?php 
            (isset($c->options_color)) ? $textWhite = "text-white" : $textWhite = "";
        ?>
        <tr id="heading{{ $c->id }}" class="bg-{{ $c->options_color }} <?=$textWhite ?>">
            <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}" >
                <span class="text-truncate text-break w-08-rem d-inline-block pl-0 pr-0">{{ $c->name }}</span>
            </td>
            <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">
            <span class="text-truncate text-break w-08-rem d-inline-block pl-0 pr-0">{{ $c->firstname }}</span>
            </td>
            <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">{{ $c->phone }} </td>
            <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">
                <span class="text-truncate text-break w-08-rem d-inline-block pl-0 pr-0">{{ $c->email }}</span>
            </td>
            <td data-toggle="collapse" data-target="#collapse{{ $c->id }}" aria-expanded="false" aria-controls="collapse{{ $c->id }}">
                <span class="text-truncate text-break w-08-rem d-inline-block pl-0 pr-0">{{ $c->type_de_bien }}</span>
                <div class="mt-2">
                    <?=($metrics->staticBien($c->type_de_bien))['optionColor'] ?>
                </div>
            </td>
            <td colspan="2" class="text-center">
                <div>
                    <a class="btn btn-info btn-sm" href="{{ route('client.show', ['client' => $c->id]) }}">details</a>
                    <a class="btn btn-warning btn-sm" href="{{ route('client.edit', ['client' => $c->id]) }}">editer</a>
                </div>
                <div class="mt-2">
                    <a id="supprimer" class="btn btn-danger btn-sm" href="{{ route('client.delete', ['client' => $c->id]) }}">supprimer</a>
                </div>
            </td>
        </tr>
        <tr class="collapse" id="collapse{{ $c->id }}" aria-labelledby="heading{{ $c->id }}" data-parent="#accordionExample">
            <td colspan="6">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="date_contact">Date de contact</label>
                            <input id="date_contact" value="{{ \Carbon\Carbon::parse($c->date_contact)->format('d/m/Y') }}" disabled type="text" class="form-control" name="date_contact">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="etat">Etat</label>
                            <input id="etat" value="{{ $c->etat }}" disabled type="text" class="form-control" name="etat">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="actif">Actif</label>
                            <input id="actif" value="{{ $c->actif }}" disabled type="text" class="form-control" name="actif">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="commentaires">Commentaires</label>
                        <textarea id="commentaires" class="form-control" disabled name="commentaires" cols="5" rows="5">{{ $c->commentaires }}</textarea>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach @else
        <p class="text-center bg-info text-white">
            Aucun client enregistré
        </p>
        @endif
    </tbody>
</table>