@extends ('layouts.admin')

@section ('title','Lista de Usuarios')
@section ('contenido')


<table class="table">
<thead>
	<th>Id</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Email</th>
	<th>Profile</th>
	<th>Update</th>
	<th>Delete</th>
</thead>
<tbody>
@foreach($data as $user)
     <tr>
     	<td>{{$user->id}}</td>
     	<td>{{$user->nombre}}</td>
     	<td>{{$user->apellido}}</td>
     	<td>{{$user->email}}</td>
     	<td>{{$user->perfil}}</td>
     	<td><a class="btn btn-success" href="{{asset('user/edit')}}/{{$user->id}}">Update</a></td>

     	<td><a href="" data-target="#modal-delete-{{$user->id}}" data-toggle="modal"><button class="btn btn-danger">Delete</button></a></td>
     </tr>
     @include('user.user-modal')
@endforeach

</tbody>
</table>

{{ $data->links() }}

@endsection