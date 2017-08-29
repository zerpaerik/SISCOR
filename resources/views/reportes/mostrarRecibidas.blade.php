<div class="row">
  <div id="paginacion">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
      <div class="card">
        <div class="card-action">
          <b>Correspondencia Recibida</b>
        </div>

       @foreach($recibidas as $correspondencia)
        
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
  
          </div>
        </div>
      @endforeach
      </div>
    </div>
  </div>

</div>

<!-- Recursos javascript-ajax -->
<!-- <script src="{{asset('assets/js/recursos.js')}}"></script> -->
