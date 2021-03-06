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
                  <label for="usuario">Usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario"
                    placeholder="Introduzca las iniciales" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="contrasena">Contraseña</label>
                  <input type="password" class="form-control" id="contrasena" name="contrasena"
                    placeholder="Introduzca la contraseña" required autocomplete="off">
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
                    <div id="depbydir"></div>
                </div>

                <div class="form-group">
                    <div id="dirbydiv"></div>
                </div>


                <div class="form-group">
                  <label for="cargo">Descripción de Cargo</label>
                  <input type="text" class="form-control" id="cargo" name="cargo"
                    placeholder="Introduzca la descripcion del cargo" required autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="perfil">Perfil</label>
                  <select name="perfil" id="perfil" class="form-control" placeholder="Seleccione el Perfíl">
                    <option value="00">Seleccione</option>
                    <option value="10">Director General/ Presid / Secret</option>
                    <option value="20">Asistente Director</option>
                    <option value="30">Director-Coord</option>
                    <option value="40">Analistas</option>
                    <option value="40">Analistas</option>
                   
                  </select>
                </div>

                <div class="form-group">
                  <label for="tipo_usuario">Tipo de Usuario</label>
                  <select name="tipo_usuario" id="tipo_usuario" class="form-control" placeholder="Seleccione el Perfíl">
                    <option value="00">Seleccione</option>
                    <option value="1">Regular</option>
                    <option value="2">Admin</option>
                    
                  </select>
                </div>

                 <div class="form-group">
                  <label for="aprobador">Aprobador</label>
                  <select name="aprobador" id="aprobador" class="form-control" placeholder="Es aprobador?">
                    <option value="00">Seleccione</option>
                    <option value="0">No</option>
                    <option value="1">Si</option>
                    
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
            //$('#create').submit(function (event) {
              //$('#bt').on('click',function (event){
                //$('#create').submit(function (event) {
               //$('#bt').on('click',function (event){
               $('#create').submit(function (event) {
                var formData = {
                     //campo para controlador    //tipo de campo[name=namecampo]
                    'cedula'                    : $('input[name=cedula]').val(),
                    'nombres'                   : $('input[name=nombres]').val(),
                    'apellidos'                 : $('input[name=apellidos]').val(),
                    'usuario'                   : $('input[name=usuario]').val(),
                    'contrasena'                : $('input[name=contrasena]').val(),
                    'iniciales'                 : $('input[name=iniciales]').val(),
                    'id_org'                    : $('select[name=id_org]').val(),
                    'id_dep'                    : $('select[name=id_dep]').val(),
                    'id_dir'                    : $('select[name=id_dir]').val(),
                    'id_div'                    : $('select[name=id_div]').val(),
                    'cargo'                     : $('input[name=cargo]').val(),
                    'perfil'                    : $('select[name=perfil]').val(),
                    'tipo_usuario'              : $('select[name=tipo_usuario]').val(),
                    'aprobador'                 : $('select[name=aprobador]').val(),
                };

                //validaciones 
                var valido=1;
                var mensaje="";
                //si no se ha seleccionado un organismo select tiene valor 00

                if(formData['cedula']==""){
                  valido  = 0;
                  mensaje = "Debe introducir la cedula del usuario";
                  alert(mensaje); 
                } else if (formData['nombres'].length <= 3 || formData['nombres'].length >=9){
                  valido = 0;
                  mensaje = "Debe verificar la longitud del nombre";
                  alert(mensaje);
                } else if (formData['apellidos'].length <= 3 || formData['apellidos'].length >=9){
                  valido = 0;
                  mensaje = "Debe verificar la longitud del apellido";
                  alert(mensaje);
                } 
                //si pasa todas las validaciones valido sigue siendo 1, se ejecuta form
                if (valido == 1) {
                // procesamiento del  form
                $.ajax({
                    type        : 'POST',                               //metodo
                    url         : '<?= asset('usuarios/store') ?>', //controlador
                    data        : formData,                             //array con nombres de campos
                    dataType    : 'json',                               //tipo de salida
                    encode      : true                                  //decodificacion
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

