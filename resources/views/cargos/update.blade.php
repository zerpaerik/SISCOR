    <div class="row">
	    <div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="card">
    			<div class="card-action">
        			<b>Actualizar Cargos</b>
    			</div>
    			<div class="card-content">
<form role="form" action="{{asset('cargos/update')}}/{{$data->id}}" id="update">

  <div class="form-group">
    <label for="descripcion">Nombre del Cargo</label>
    <input type="text" class="form-control" id="descripcion" name="descripcion"
           placeholder="Introduce tu nombre" required="" value="{{$data->descripcion}}" required autocomplete="off">
  </div>
  <button type="submit" class=" waves-effect waves-light btn">Actualizar</button>
</form>
				</div>    		
    		</div>          
    	</div>
    </div>

    <script type="text/javascript">
            //Envio por ajax de formulario por id fijarse atributo id de form
            $('#update').submit(function (event) {
            	var formData = {
                     //campo para controlador    //tipo de campo[name=namecampo]
                    'descripcion'             : $('input[name=descripcion]').val(),
                };
                //validaciones 
                var valido=1;
                var mensaje="";
                //verifica la longitud de la descripcion
                if (formData['descripcion'].length <=7 || formData['descripcion'].length >=51){
                  valido   = 0;
                  mensaje = "Verifique la longitud del nombre del cargo";
                  alert(mensaje);  
                }

                if (valido == 1) {
                // process the form
                $.ajax({
                    type        : 'PUT',                              //metodo
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
                      $('.edit').empty();
                      recargar();                 
                    }
                });

                }
                // previene que se ejecute submit dando enter
                event.preventDefault();
            });

            function recargar(){
            	 $('#paginacion').empty();
            	 $.ajax({
                 	type: "get",
                	url: "{{ asset('/cargos/listCargos') }}",
                 	success: function(a) {
                    	$('#paginacion').html(a);
                 	}
              	 });
            }
    </script>
