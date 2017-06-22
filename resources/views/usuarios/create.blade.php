    <div class="row">
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="card">
          <div class="card-action">
              <b>Crear Usuarios</b>
          </div>
          <div class="card-content">
          <!-- Aqui es donde va el form-->
            <form role="form" id="create" method="POST">
                 
                <div class="form-group">
                  <label for="cedula">Cédula de Identidad</label>
                  <input type="text" class="form-control" id="cedula" name="cedula"
                    placeholder="Introduzca la Cédula de Identidad" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="nombres">Nombres</label>
                  <input type="text" class="form-control" id="nombres" name="nombres"
                    placeholder="Introduzca el nombre" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="apellidos">Apellidos</label>
                  <input type="text" class="form-control" id="apellidos" name="apellidos"
                    placeholder="Introduzca el apellido" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="iniciales">Iniciales</label>
                  <input type="text" class="form-control" id="iniciales" name="iniciales"
                    placeholder="Introduzca las iniciales" required autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="id_org">Nombre de Organismo</label>
                  <select name="id_org" id="id_org" class="form-control" placeholder="Seleccione el  organismo">
                    <option value="00">Seleccione</option>
                    @foreach ($organismo as $org)
                      <option value="{{$org->id}}">{{$org->descripcion}}</option>
                    @endforeach
                  </select>
                </div>


                <div class="form-group">
                    <div id="orgbydep"></div>
                </div>

                <div class="form-group">
                  <label for="id_cargo">Nombre de Cargo</label>
                  <select name="id_cargo" id="id_cargo" class="form-control" placeholder="Seleccione el Cargo">
                    <option value="00">Seleccione</option>
                    @foreach ($dependencia as $dep)
                      <option value="{{$dep->id}}">{{$dep->descripcion}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="perfil">Perfíl</label>
                  <select name="perfil" id="perfil" class="form-control" placeholder="Seleccione el Perfíl">
                    <option value="0">Seleccione</option>
                    <option value="1">Usuario</option>
                    <option value="2">Admin</option>
                    
                  </select>
                </div>
 
                <button type="submit" class="waves-effect waves-light btn">Guardar</button>
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
                    'id_org'                  : $('select[name=id_org]').val(),
                    'descripcion'             : $('input[name=descripcion]').val(),
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
                }else if (formData['descripcion'].length <= 7 || formData['descripcion'].length >=51){
                  valido   = 0;
                  mensaje = "Verifique la longitud del nombre de dependencia";
                  alert(mensaje);  
                }
                //si pasa todas las validaciones valido sigue siendo 1, se ejecuta form
                if (valido == 1) {
                // procesamiento del  form
                $.ajax({
                    type        : 'POST',                               //metodo
                    url         : '<?= asset('dependencias/store') ?>', //controlador
                    data        : formData,                             //array con nombres de campos
                    dataType    : 'json',                               //tipo de salida
                    encode      : true                                  //decodificacion
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
                //muestra mensaje de error si no se valida
                }

                // previene que se ejecute submit dando enter
                event.preventDefault();
            });
    </script>

    <script type="text/javascript">
        $('#id_org').on('change',function(){
          var id= $('#id_org').val();
          var link= '{{asset("usuarios/orgbydep/id")}}';
              link= link.replace('id',id);
          $.ajax({
                 type: "get",
                 url: link ,
                 success: function(a) {
                    $('#orgbydep').html(a);
                 }
          });

        });
    </script>