    <div class="row">
	    <div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="card">
    			<div class="card-action">
        			<b>Cambiar Contraseña</b>
    			</div>
    			<div class="card-content">
<form role="form" action="{{asset('usuarios/updatepasswd')}}/{{$data->id}}" id="update">

  <div class="form-group">
    <label for="contrasena">Contraseña</label>
    <input type="text" class="form-control" id="contrasena" name="contrasena"
           placeholder="Introduce tu nombre" required="" value="{{$data->contrasena}}" required autocomplete="off">
  </div>
  <div class="form-group">
    <label for="contrasena">Nueva Contraseña</label>
    <input type="password" class="form-control" id="contrasena" name="contrasena"
           placeholder="Introduce tu nombre" required="" required autocomplete="off">
  </div>
  <button type="submit" class=" waves-effect waves-light btn">Actualizar</button>
  <button type="reset" class=" waves-effect waves-light btn">Limpiar</button>
</form>
				</div>    		
    		</div>          
    	</div>
    </div>

 
