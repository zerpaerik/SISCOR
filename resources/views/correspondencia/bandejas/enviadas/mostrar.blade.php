<div class="row">
  <div id="paginacion">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
      <div class="card">
        <div class="card-action">
          <b>Correspondencia Enviada</b>
        </div>

       @foreach($data as $correspondencia)
        
        <div class="panel panel-success">
            
          <div class="panel-heading">
            <div class="row">
                <div class="pull-right"><b>Correspondencia N°:</b> {{$correspondencia->id_correspondencia}}  &nbsp;</div>
            </div>
            <div class="row">
                <div class="pull-right"><b>Fecha:</b> {{date("d-m-Y g:i A",strtotime($correspondencia->fecha_emision))}}  &nbsp;</div>
            </div>
            <div class="row">
                <div>&nbsp;<b>Asunto:</b> {{$correspondencia->asunto}}</div>
            </div>
            <div class="row">
                <div>&nbsp;<b>Organismo:</b> {{$correspondencia->descripcion}}</div>
            </div>
            <div class="row">
                <div>&nbsp;<b>Dependencia:</b> {{$correspondencia->descripcion}}</div>
            </div>
            <div class="row">
                <div >&nbsp;<b>Contenido:</b></div>
            </div>
          </div>
          <div class="panel-body" id="contenido">
             {{$correspondencia->contenido}}
          </div>
          <div class="panel-footer">
            <div class="row">
                <div class="pull-right">
                  <button href="{{asset('correspondencia/aprobarCorrespondencia')}}/{{$correspondencia->id}}" 
                  id="aprobar" class="waves-effect waves-light btn">Imprimir</button>
         
                  &nbsp;
                </div>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
  </div>

</div>

<!-- Recursos javascript-ajax -->
<script src="{{asset('assets/js/recursos.js')}}"></script> 

<script type="text/javascript">
    $('#aprobar').on('click',function(event){
          //variable que obtiene el atributo del campo que ejecuta el click
          var url = $(this).attr('href');
          //implementación del plugin
          swal({
                //configuración del plugin
                title: "¿Desea Aprobar la Correspondencia?",
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
                                swal("Correspondencia Aprobada con Éxito");
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

    CKEDITOR.replace( 'contenido' );
    CKEDITOR.config.readOnly = true;

</script>
