@extends ('layouts.admin')
@section ('contenido')

<form role="form" action="{{asset('user/update')}}/{{$data->id}}" method="PUT">
  {{Form::token()}}

  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email"
           placeholder="Introduce tu email" required="" value="{{$data->email}}" required autocomplete="off">
  </div>
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre"
           placeholder="Introduce tu nombre" required="" value="{{$data->nombre}}" required autocomplete="off">
  </div>
  <div class="form-group">
    <label for="apellido">Apellido</label>
    <input type="text" class="form-control" id="apellido" name="apellido"
           placeholder="Introduce tu apellido" required="" value="{{$data->apellido}}" required autocomplete="off">
  </div>
  <div class="form-group" >
    <label for="perfil">Perfil</label>
    <div class="form-control">
          @if($data->perfil=="0")
            <input type="radio"  id="perfil" name="perfil" value="0" checked required>Usuario
            <input type="radio"  id="perfil" name="perfil" value="1" required>Admin
          @else
            <input type="radio"  id="perfil" name="perfil" value="0" required>Usuario
            <input type="radio"  id="perfil" name="perfil" value="1" checked required>Admin
          @endif
    </div>
  </div>
  <button type="submit" class="btn btn-default">Update</button>
</form>

@endsection