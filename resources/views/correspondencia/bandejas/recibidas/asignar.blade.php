   <div class="row">
                <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
      <form role="form" action="{{asset('correspondencia/asignarCorrespondencia')}}/{{$correspondencia->id}}" id="asignarCorrespondencia">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Asignar Correspondencia</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="id_usuario_asignado">Destinatario</label>
                  <select name="id" id="id_usuario_asignado" name="id_usuario_asignado" class="form-control" placeholder="Seleccione el Destinatario">
                    <option value="00">Seleccione</option>
                    <option value="4">Juleisa Toledo</option>
                    <option value="00">Pedro Perez</option>
                   
                  </select>
                </div>

                <div class="form-group">
                  <label for="id_instruccion">Instrucción</label>
                  <select  id="id_instruccion" name="id_instruccion" class="form-control" placeholder="Seleccione la Instrucción">
                    <option value="00">Seleccione</option>
                    <option value="1">Elaborar Respuesta</option>
                    <option value="2">Notificar</option>
                    <option value="3">Asistir</option>
                    <option value="4">Reasignar</option>
                    <option value="5">Confirmar</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="comentario">Comentario:</label>
                  <textarea class="form-control" rows="5" id="comentario" name="comentario"></textarea>
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
                   
                     $("#asignarCorrespondencia").submit();



                            });        
              });
    });
  </script>