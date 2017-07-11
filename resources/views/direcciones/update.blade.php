  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="card-action">
              <b>Actualizar Direcciones</b>
          </div>
          <div class="card-content">
          <form role="form" action="{{asset('direcciones/update')}}/{{$data->id}}" id="update">

              <div class="form-group">
                <label for="id_org">Nombre de Organismo</label>
                @foreach($organismos as $org)
                  @if($data->id_org == $org->id)
                  <input type="text" class="form-control" value="{{$org->descripcion}}" readonly>
                  @endif
                @endforeach
              </div>

              <div class="form-group">
                <label for="id_dep">Nombre de Dependencia</label>
                @foreach($dependencia as $dep)
                  @if($data->id_dep == $dep->id)
                  <input type="text" class="form-control" value="{{$dep->descripcion}}" readonly>
                  @endif
                @endforeach
              </div>

              <div class="form-group">
                <label for="descripcion">Nombre de Dirección</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion"
                         required="" value="{{$data->descripcion}}" required autocomplete="off">
              </div>

              <div class="form-group">
                  <label for="siglas">Siglas de Dirección</label>
                  <input type="text" class="form-control" id="siglas" name="siglas"
                    placeholder="Introduzca las siglas de la dependencia" value="{{$data->siglas}}" required autocomplete="off">
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
                    'id_org'                  : $('select[name=id_org]').val(),
                    'id_dep'                  : $('select[name=id_dep]').val(),
                    'descripcion'             : $('input[name=descripcion]').val(),
                    'siglas'                  : $('input[name=siglas]').val(),

                };
                    //validaciones 
                var valido=1;
                var mensaje="";
                //si no se ha seleccionado un organismo select tiene valor 00
                if(formData['id_org']=="00"){
                  valido   = 0;
                  mensaje = "Debe seleccionar organismo";
                  alert(mensaje);  
                //si la longitud de la descripcion tiene menos de 7 o mas de 50 caracteres
                }else if (formData['id_dep']=="00"){
                  valido   = 0;
                  mensaje = "Debe seleccionar la dependencia";
                  alert(mensaje);  
                }else if (formData['descripcion']==""){
                  valido   = 0;
                  mensaje = "Debe actualizar el nombre de la direccion";
                  alert(mensaje);  
                }else if (formData['siglas']==""){
                  valido = 0;
                  mensaje = "Debe actualizar las siglas de la direccion"
                }
                ////////////////////////
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
                  url: "{{ asset('/direcciones/listDirecciones') }}",
                  success: function(a) {
                      $('#paginacion').html(a);
                  }
                 });
            }
    </script>
