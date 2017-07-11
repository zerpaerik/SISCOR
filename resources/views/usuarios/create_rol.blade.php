          
    <div class="row">
	    <div class="col-md-8 col-sm-12 col-xs-12">
    		<div class="card">
    			<div class="card-action">
        			<b>Crear Roles</b>
    			</div>
    			<div class="card-content">
    			<!-- Aqui es donde va el form-->
				<form role="form" id="crear_rol" method="POST" action="{{asset('usuarios/crear_rol')}}">
          
					<div class="form-group">
    					<label for="name">Nombre</label>
    					<input type="text" class="form-control" id="name" name="name"
           				placeholder="Introduzca el nombre del Rol" required autocomplete="off">
  					</div>
            <div class="form-group">
              <label for="slug">Alias*</label>
              <input type="text" class="form-control" id="slug" name="slug"
                  placeholder="Introduzca el slug del rol" required autocomplete="off">
            </div>

            <div class="form-group">
              <label for="description">Descripcion</label>
              <input type="text" class="form-control" id="description" name="description"
                  placeholder="Introduzca la descripcion del rol" required autocomplete="off">
            </div>
  				    <button type="submit" class=" waves-effect waves-light btn">Guardar</button>
  					<input type="reset" class="btn btn-info" value="Limpiar"> 
				</form>
    			<!-- Aqui es donde va el form-->
				</div>    		
    		</div>          
    	</div>
    </div>


    <script type="text/javascript">
            //Envio por ajax de formulario por id fijarse atributo id de form
            $('#create').submit(function (event) {
                var formData = {
                     //campo para controlador    //tipo de campo[name=namecampo]
                    'name'                    : $('input[name=name]').val(),
                    'slug'                    : $('input[name=slug]').val()
                    'description'             : $('input[name=description]').val()
                };
                //validaciones 
                var valido=1;
                var mensaje="";
                //verifica la longitud de la descripcion
                if (formData['description'].length <= 7 || formData['description'].length >=51){
                  valido   = 0;
                  mensaje = "Verifique la longitud de la descripcion";
                  alert(mensaje);  
                }
                //si pasa todas las validaciones valido sigue siendo 1, se ejecuta form
                if (valido == 1) {

                // process the form
                $.ajax({
                    type        : 'POST',                             //metodo
                    url         : $(this).attr("action"),             //controlador
                    data        : formData,                           //array con nombres de campos
                    dataType    : 'json',                             //tipo de salida
                    encode      : true                                //decodificacion
                }).done(function(data) {
                    //ejecuta el y despliega el mensaje json obtenido
                    //si respuesta del json es fail
                    if (data.respuesta=="fail") {
                      //mensaje rojo , dura 3 segs
                      toastr.danger(data.mensaje, {timeOut: 300});  
                    }else{
                      //mensaje azul , dura 3 segs
                      toastr.info(data.mensaje, {timeOut: 300}); 
                      //limpia todos los campos del form 
                      $('#create')[0].reset();                 
                    }
                  
                });
                }
                // previene que se ejecute submit dando enter
                event.preventDefault();
            });
    </script>
