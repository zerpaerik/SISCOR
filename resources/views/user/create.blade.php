@extends ('layouts.admin')
@section ('contenido')

<form role="form" action="{{asset('user/store')}}" method="POST">
  {{Form::token()}}

  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email"
           placeholder="Enter your Email" required autocomplete="off">
  </div>
  <div class="form-group">
    <label for="nombre">First Name</label>
    <input type="text" class="form-control" id="nombre" name="nombre"
           placeholder="Enter your First Name" required autocomplete="off">
  </div>
  <div class="form-group">
    <label for="apellido">Last Name</label>
    <input type="text" class="form-control" id="apellido" name="apellido"
           placeholder="Enter your Last Name" required autocomplete="off">
  </div>
  <div class="form-group">
    <label for="contrasena">Password</label>
    <input type="password" class="form-control" id="contrasena" name="contrasena"
           placeholder="Enter your Password" required autocomplete="off">
  </div>
  <div class="form-group" >
    <label for="perfil">Profile</label>
    <div class="form-control">
          <input type="radio"  id="perfil" name="perfil" value="0" checked required>User
          <input type="radio"  id="perfil" name="perfil" value="1" required>Admin
    </div>
  </div>
  <button type="submit" class="btn btn-default">Save</button>
</form>

@endsection