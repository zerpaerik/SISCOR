    <div class="row">
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="card">
          <div class="card-action">
            
          </div>
         

<div class="panel panel-default">
  <div class="panel-heading">Correspondencia Pendiente por Aprobar</div>
  
  <ul class="list-group">
    <li class="list-group-item">Número de Correspondencia:</li>
    <li class="list-group-item">Confidencialidad:</li>
    <li class="list-group-item">Tipo de Correspondencia:</li>
    <li class="list-group-item">Organismo:</li>
    <li class="list-group-item">Dependencia:</li>
    <li class="list-group-item">Adjunto:</li>
    <li class="list-group-item">Contenido:</li>
  </ul>
<tbody>
          @foreach($data as $correspondencia)
            <tr>
              <td>{{$correspondencia->id_correspondencia}}</td>
              <td>{{$correspondencia->asunto}}</td>
              <td>{{$correspondencia->descripcion}}</td>
              <td>{{$correspondencia->descripcion}}</td>
              <td>{{$correspondencia->asunto}}</td>
              <td>{{$correspondencia->asunto}}</td>
              <td>{{$correspondencia->asunto}}</td>
          
            </tr>
          @endforeach

        </tbody>

</div>

          <!-- Aqui es donde va el form-->
           
          <!-- Aqui es donde va el form-->
        </div>        
        </div>          
      </div>
    </div>
