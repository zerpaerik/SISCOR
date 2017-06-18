           
    <div class="row">
	    <div class="col-md-8 col-sm-12 col-xs-12">
    		<div class="card">
    			<div class="card-action">
        			<b>Crear Organismos</b>
    			</div>
    			<div class="card-content">
    			<!-- Aqui es donde va el form-->
				<form role="form" id="create" method="POST" action="{{asset('organismos/store')}}">

					<div class="form-group">
    					<label for="nombre">Nombre de Organismo</label>
    					<input type="text" class="form-control" id="descripcion" name="descripcion"
           				placeholder="Introduzca el nombre del Organismo y/o Ente" required autocomplete="off">
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
                    'descripcion'             : $('input[name=descripcion]').val(),
                };
                //validaciones 
                var valido=1;
                var mensaje="";
                //verifica la longitud de la descripcion
                if (formData['descripcion'].length <= 7 || formData['descripcion'].length >=51){
                  valido   = 0;
                  mensaje = "Verifique la longitud del nombre del organismo";
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
