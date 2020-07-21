<table id="customer_data" class="table table-bordered">
    <thead class="thead-light"> 
        <th>Id</th>      
        <th>Nom et Prén.</th>
        <th>Email</th>        
        <th colspan="3" class="text-center">Actions</th>
    </thead>
    <tbody> 
        @if(count($user) > 0) @foreach($user as $c)
        <tr>      
            <td>{{ $c->id }}</td>      
            <td>{{ $c->name }}</td>
            <td>{{ $c->email }}</td>                             
            <td colspan="3" class="text-center">                
                <a class="btn btn-warning btn-sm" href="{{ route('admin.edit', ['user' => $c->id]) }}">editer</a>
                <a id="supprimer" class="btn btn-danger btn-sm" href="{{ route('admin.delete', ['user' => $c->id]) }}">supprimer</a>
            </td>
        </tr>
        @endforeach @else
        <p class="text-center bg-info text-white">
            Aucun client enregistré
        </p>
        @endif
    </tbody>
</table>