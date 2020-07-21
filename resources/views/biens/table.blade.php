<table class="table table-bordered">
    <thead class="thead-light">
        <th>#ID</th>
        <th>Nom</th>
        <th>Nb clients</th>
        <th colspan="3" class="text-center">Actions</th>
    </thead>
    <tbody>
        @if(count($biens) > 0) 
            @foreach($biens as $g)
            <tr>
                <td scope="row">{{ $g->id }}</td>
                <td>{{ $g->name }}</td>
                <th>{{ $g->clients()->count() }}</th>
                <td colspan="3" class="text-center">
                    <a class="btn btn-info btn-sm" href="{{ route('bien.show', ['bien' => $g->id]) }}">details</a>
                    <a class="btn btn-warning btn-sm" href="{{ route('bien.edit', ['bien' => $g->id]) }}">editer</a>
                    <a class="btn btn-danger btn-sm" href="{{ route('bien.delete', ['bien' => $g->id]) }}">supprimer</a>
                </td>
            </tr>
            @endforeach 
        @else
            <p class="text-center bg-info text-white">
                Aucun bien enregistré
            </p>
        @endif
    </tbody>
</table>