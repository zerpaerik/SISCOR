<div class="row">
  <div id="paginacion">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
      <div class="card">
        <div class="card-action">
        <div class="">
          <b>Correspondencia Enviada</b>
        </div>      
        </div>

       @foreach($data as $correspondencia)
              
         <div class="panel panel-default">
         <div class="panel-heading">
         <h3 class="panel-title">Número de Correspondencia</h3>
         </div>
         <div class="panel-body">
         <td>{{$correspondencia->id_correspondencia}}</td>
         </div>
         </div>

         <div class="panel panel-default">
         <div class="panel-heading">
         <h3 class="panel-title">Asunto</h3>
         </div>
         <div class="panel-body">
         <td>{{$correspondencia->asunto}}</td>
         </div>
         </div>

         <div class="panel panel-default">
         <div class="panel-heading">
         <h3 class="panel-title">Organismo</h3>
         </div>
         <div class="panel-body">
         <td>{{$correspondencia->descripcion}}</td>
         </div>
         </div>


         <div class="panel panel-default">
         <div class="panel-heading">
         <h3 class="panel-title">Dependencia</h3>
         </div>
         <div class="panel-body">
         <td>{{$correspondencia->descripcion}}</td>
         </div>
         </div>

         <div class="panel panel-default">
         <div class="panel-heading">
         <h3 class="panel-title">Contenido</h3>
         </div>
         <div class="panel-body">
         <td>{{$correspondencia->contenido}}</td>
         </div>
         </div>

          @endforeach
          <td>
                <input type="button" 
                         class=" waves-effect waves-light btn verEnviadas" 
                         href="{{asset('correspondencia/verEnviadas')}}/{{$correspondencia->id_correspondencia}}" 
                         value="Archivar"/>
              </td>

              <td>
                <input type="button" 
                         class=" waves-effect waves-light btn verEnviadas" 
                         href="{{asset('correspondencia/verEnviadas')}}/{{$correspondencia->id_correspondencia}}" 
                         value="Imprimir"/>
              </td>

              

      </div>
    </div>
  </div>

</div>

<!-- Recursos javascript-ajax -->
<script src="{{asset('assets/js/recursos.js')}}"></script> 