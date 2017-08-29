<h1> Correspondencia Enviada </h1>

<table>
	
	<thead>

		<tr>
			 <th>ID </th>
			 <th>ID</th>
			 <th>ID</th>
			  <th>ID</th>
			   <th>ID</th>
		</tr>
		


	</thead>

	<tbody>	


       @foreach( $data as $correspondencia )
        
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
                
              
                </div>
            </div>

      <div class="row">
      
      </div>
          </div>
        </div>
      @endforeach


	</tbody>


</table>