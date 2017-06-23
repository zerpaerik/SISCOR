    <div class="row">
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="card">
          <div class="card-action">
              <b>Crear Usuarios</b>
          </div>
          <div class="card-content">
          <!-- Aqui es donde va el form-->
            <form role="form" action="{{asset('usuarios/update')}}/{{$data->id}}" id="update">
                 
                <div class="form-group">
                  <label for="cedula">Cédula de Identidad</label>
                  <input type="text" class="form-control" id="cedula" name="cedula"
                    placeholder="Introduzca la Cédula de Identidad" value="{{$data->cedula}}" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="nombres">Nombres</label>
                  <input type="text" class="form-control" id="nombres" name="nombres"
                    placeholder="Introduzca el nombre" value="{{$data->nombres}}" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="apellidos">Apellidos</label>
                  <input type="text" class="form-control" id="apellidos" name="apellidos"
                    placeholder="Introduzca el apellido" value="{{$data->apellidos}}" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="usuario">Usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario"
                    placeholder="Introduzca las iniciales" value="{{$data->usuario}}" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="iniciales">Iniciales</label>
                  <input type="text" class="form-control" id="iniciales" name="iniciales"
                    placeholder="Introduzca las iniciales" value="{{$data->iniciales}}" required autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="id_org">Nombre de Organismo</label>
                  <select name="id_org" id="id_org" class="form-control" placeholder="Seleccione el  organismo" value="{{$data->id_org}}">
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
                  <select name="id_cargo" id="id_cargo" class="form-control" placeholder="Seleccione el Cargo" value="{{$data->id_org}}">
                    <option value="00">Seleccione</option>
                    @foreach ($organismo as $org)
                      <option value="{{$org->id}}">{{$org->descripcion}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="perfil">Perfíl</label>
                  <select name="perfil" id="perfil" class="form-control" placeholder="Seleccione el Perfíl" value="{{$data->perfil}}">
                    <option value="00">Seleccione</option>
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
                    'id_cargo'                  : $('select[name=id_org]').val(),
                    'perfil'                    : $('select[name=perfil]').val()
                };

                //validaciones 
                var valido=1;
                var mensaje="";
                //si no se ha seleccionado un organismo select tiene valor 00

                if(formData['cedula']==""){
                  valido  = 0;
                  mensaje = "Debe introducir la cedula del usuario"
                  alert(mensaje); 
                } else if (formData['nombres'].length <= 3 || formData['nombres'].length >=9){
                  valido = 0;
                  mensaje = "Debe verificar la longitud del nombre";
                } else if (formData['apellidos'].length <= 3 || formData['apellidos'].length >=20){
                  valido = 0;
                  mensaje = "Debe verificar la longitud del apellido";
                  alert(mensaje);
                } else if (formData['usuario'].length <=3 || formData['usuario'].length >=10){
                  valido = 0;
                  mensaje = "Debe verificar la longitud del usuario";
                  alert(mensaje);
                } else if (formData['iniciales'].lentgh <=1 || formData['iniciales'].length >=3){
                  valido = 0;
                  mensaje = "Debe verificar la longitud de las iniciales";
                  alert(mensaje);
                } else if (formData['id_org']=="00"){
                  valido = 0;
                  mensaje = "Debe seleccionar un organismo";
                  alert(mensaje);
                } else if (formData['id_dep']=="00"){
                  valido = 0;
                  mensaje = "Debe seleccionar una dependencia";
                  alert(mensaje);
                } else if (formData['id_cargo']=="00"){
                  valido = 0;
                  mensaje = "Debe seleccionar un cargo";
                  alert(mensaje);
                } else if (formData['perfil']=="00"){
                  valido = 0;
                  mensaje = "Debe seleccionar un perfil";
                  alert(mensaje);
                }

                //si pasa todas las validaciones valido sigue siendo 1, se ejecuta form
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
                  url: "{{ asset('/usuarios/listUsuarios') }}",
                  success: function(a) {
                      $('#paginacion').html(a);
                  }
                 });
            } 
    </script>

  