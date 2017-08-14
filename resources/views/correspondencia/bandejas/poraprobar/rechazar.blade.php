   <div class="row">
                <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Rechazar Correspondencia</h4>
        </div>
        <div class="modal-body">
               
                <div class="form-group">
                  <label for="comment">Ingrese la razon del rechazo:</label>
                  <textarea class="form-control" rows="5" id="comment"></textarea>
              </div> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button href="{{asset('correspondencia/rechazarCorrespondencia')}}/{{$correspondencia->id}}" 
                  id="rechazar" class="waves-effect waves-light btn">Guardar</button>
          <button type="reset"  class="btn btn-info" data-dismiss="modal">Limpiar</button>
        </div>
        
      </div>
      
    </div>
  </div>
  </div>


    <script type="text/javascript">
    $('#rechazar').on('click',function(event){
          //variable que obtiene el atributo del campo que ejecuta el click
          var url = $(this).attr('href');
          //implementación del plugin
          swal({
                //configuración del plugin
                title: "¿Desea Rechazar la Correspondencia?",
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
                                swal("Correspondencia Rechazada con Éxito");
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