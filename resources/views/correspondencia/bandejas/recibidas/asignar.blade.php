   <div class="row">
                <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <form role="form" id="asignarCorrespondencia" method="POST">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button"  class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Asignar Correspondencia</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="id_usuario_asignado">Destinatario</label>
                  <select name="id_usuario_asignado" id="id_usuario_asignado" class="form-control" placeholder="Seleccione el Destinatario">
                    <option value="00">Seleccione</option>
                    <option value="4">Juleisa Toledo</option>
                    <option value="00">Pedro Perez</option>
                   
                  </select>
                </div>

                <div class="form-group">
                  <label for="id_instruccion">Instrucción</label>
                  <select name="id_instruccion" id="id_instruccion" class="form-control" placeholder="Seleccione la Instrucción">
                    <option value="00">Seleccione</option>
                    <option value="10">Elaborar Respuesta</option>
                    <option value="20">Notificar</option>
                    <option value="20">Asistir</option>
                    <option value="20">Reasignar</option>
                    <option value="20">Confirmar</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="comentario">Comentario:</label>
                  <textarea class="form-control" rows="5" name="comentario" id="comentario"></textarea>
              </div> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button href="{{asset('correspondencia/asignarCorrespondencia')}}/{{$correspondencia->id}}" 
                  id="asignar" class="waves-effect waves-light btn">Guardar</button>
          <button type="reset"  class="btn btn-info" data-dismiss="modal">Limpiar</button>
        </form>
        </div>
        
      </div>
      
    </div>
  </div>
  </div>

    <script type="text/javascript">
            //Envio por ajax de formulario por id fijarse atributo id de form
           // $('#create').submit(function (event) {
              $('#asignar').on('click', function (event){
                var formData = {
                     //campo para controlador    //tipo de campo[name=namecampo]
                    'id_instruccion'             : $('select[name=id_instruccion]').val(),
                    'id_usuario_asignado'        : $('select[name=id_usuario_asignado]').val(),
                    'comentario'                 : $('input[name=comentario]').val(),
                };

                //validaciones
                var valido=1;
                var mensaje="";
                //si no se ha seleccionado un organismo select tiene valor 00
              /* if (formData['asunto'].length <= 5 || formData['asunto'].length >=51){
                  valido   = 0;
                  mensaje = "Verifique la longitud del asunto";
                  alert(mensaje); 
                //si la longitud de la descripcion tiene menos de 7 o mas de 50 caracteres
                }*/
                //si pasa todas las validaciones valido sigue siendo 1, se ejecuta form
                if (valido == 1) {
                // procesamiento del  form
                $.ajax({
                          type        : 'POST',                               //metodo
                          url         : '<?= asset('correspondencia/asignarCorrespondencia') ?>', //controlador
                          data: new FormData($("#asignarCorrespondencia")[0]),
                          dataType:'json',
                          async:false,
                          type:'post',
                          processData: false,
                          contentType: false,
                }).done(function(data) {
                    //ejecuta el y despliega el mensaje json obtenido
                    //si respuesta del json es fail
                    if (data.respuesta=="fail") {
                      //mensaje rojo , dura 3 segs
                      toastr.error(data.mensaje, {timeOut: 300}); 
                    }else{
                      //mensaje azul , dura 3 segs
                      toastr.info(data.mensaje, {timeOut: 300});
                      //limpia todos los campos del form
                      $('#asignarCorrespondencia')[0].reset();                
                    }
                 
                });
                //muestra mensaje de error si no se valida
                }

                // previene que se ejecute submit dando enter
                event.preventDefault();
            });

    </script>

    <script type="text/javascript">
    $('#asignar').on('click',function(event){
          //variable que obtiene el atributo del campo que ejecuta el click
          var url = $(this).attr('href');
          //implementación del plugin
          swal({
                //configuración del plugin
                title: "¿Desea Asignar la Correspondencia?",
                text: "¡Presione Aceptar!",
                type: "info",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
              },
              function(){
                    //ajax que hace la peticion por get a la url
                    $.ajax({
                              url: url,
                              type: "get",
                              //si la respuesta del controlador es true
                              success: function(data){
                                swal("Correspondencia Asignada con Éxito");
                                setTimeout(function(){location.reload();}, 2000);
                              },
                              //si no
                              error: function()
                              {
                                swal("Error obteniendo respuesta del servidor");
                              }
                            });        
              });
    });
  </script>