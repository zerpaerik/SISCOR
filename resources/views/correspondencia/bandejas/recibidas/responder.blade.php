   <div class="row">
                <!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
      <form role="form" action="{{asset('correspondencia/responderCorrespondencia')}}/{{$correspondencia->id}}" id="rechazarCorrespondencia">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Responder Correspondencia</h4>
        </div>
        <div class="modal-body">


                 <div class="form-group">
                  <label for="asunto">Asunto</label>
                  <input type="text" class="form-control" id="asunto" name="asunto"
                    placeholder="Introduzca el asunto de la correspondencia" required autocomplete="off">
                </div>
               
                <div class="form-group">
                  <label for="contenido">Ingrese la Respuesta:</label>
                  <textarea class="form-control" rows="5" id="contenido" name="contenido"></textarea>
              </div> 

                <div class="form-group">
                  <div class="file-field input-field">
                    <div class="btn">
                      <span>Adjuntar Archivo</span>
                      <input type="file" name="adjunto" id="adjunto">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Adjuntar el archivo">
                    </div>
                  </div>
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button href="{{asset('correspondencia/responderCorrespondencia')}}/{{$correspondencia->id}}" 
                  id="responder" class="waves-effect waves-light btn">Enviar</button>
          </form>
        </div>
        
      </div>
      
    </div>
  </div>
  </div>

    <script type="text/javascript">
    $('#responder').on('click',function(event){
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
                   
                           $("#responderCorrespondencia").submit();
 

                            });        
              });
    });

  </script>

  <script type="text/javascript">
     CKEDITOR.replace( 'contenido' );
     CKEDITOR.config.readOnly = true;
  </script>