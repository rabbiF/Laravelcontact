<table id="customer_data" class="table table-bordered">
    <thead class="thead-light">        
        <th>Tél.</th>
        <th>Email</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Bien</th>
        <th colspan="3" class="text-center">Actions</th>
    </thead>
    <tbody id="accordionExample"> 
        @if(count($clients) > 0) @foreach($clients as $c)
        <tr>
            <td id="heading{{ $c->id }}">  
                <button class="btn btn-link collapsed  py-0" type="button" data-toggle="collapse" data-target="#collapseExample{{ $c->id }}" aria-expanded="false" aria-controls="collapseExample{{ $c->id }}">
                    {{ $c->phone }}
                </button>

                <div class="collapse" id="collapseExample{{ $c->id }}" aria-labelledby="heading{{ $c->id }}" data-parent="#accordionExample">
                    <div class="card card-body">
                    <form>
                    <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="date_contact">Date de contact</label>
                                <input id="date_contact" value="{{ \Carbon\Carbon::parse($c->date_contact)->format('d/m/Y') }}" disabled type="text" class="form-control" name="date_contact">
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="commentaires">Commentaires</label>
                            <textarea id="commentaires" class="form-control" disabled name="commentaires" cols="5" rows="5">{{ $c->commentaires }}</textarea>                            
                        </div>
                    </form>
                    </div>
                </div>  
            </td>
            <th>{{ $c->email }}</th>
            <th>{{ $c->name }}</th>
            <th>{{ $c->firstname }}</th>
            <th>{{ $c->type_de_bien }}</th>
            <td colspan="3" class="text-center">
                <a class="btn btn-info btn-sm" href="{{ route('client.show', ['client' => $c->id]) }}">details</a>
                <a class="btn btn-warning btn-sm" href="{{ route('client.edit', ['client' => $c->id]) }}">editer</a>
                <a id="supprimer" class="btn btn-danger btn-sm" href="{{ route('client.delete', ['client' => $c->id]) }}">supprimer</a>
            </td>
        </tr>
        @endforeach @else
        <p class="text-center bg-info text-white">
            Aucun client enregistré
        </p>
        @endif
    </tbody>
</table>