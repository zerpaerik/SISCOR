                <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    
    <form role="form" id="asignarCorrespondencia" method="POST" action="{{asset('correspondencia/asignarCorrespondencia')}}/{{$correspondencia->id}}">
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
                    <option value="30">Asistir</option>
                    <option value="40">Reasignar</option>
                    <option value="50">Confirmar</option>
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


    <script type="text/javascript">
    $('#asignar').on('click',function(event){
          //variable que obtiene el atributo del campo que ejecuta el click
          var url = $(this).attr('{{asset('correspondencia/asignarCorrespondencia')}}');
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
                   
                  // $("#asignarCorrespondencia").submit(); if (data.respuesta=="fail") {
                      //mensaje rojo , dura 3 segs
                              $("#asignarCorrespondencia").submit();
                });
                //muestra mensaje de error si no se valida
                }
                    //ajax que hace la peticion por get a la url
                          
              });
    });
  </script>