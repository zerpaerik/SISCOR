<!DOCTYPE html>
<html>
<head>
  <title></title>

  <style>
    <?php include(public_path().'/assets/css/bootstrap.css');?>
  </style>


</head>
<body>
  <div class="row">
    <div id="paginacion">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       @foreach($recibidas as $correspondencia)
        <div class="panel ">
          <img style="width: 100%; height: 100px"
               src="http://23.253.41.33/wp-content/uploads/10.208.149.45/uploads/2014/02/luzazul.jpeg"> 
          <div class="panel-heading">
            <div class="row"><!--un row es una fila-->
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
<?php for($i=1;$i<=100;$i++){ ?>
          <div class="panel-body" id="contenido">
             {{$correspondencia->contenido}}
          </div>
          <?php } ?>
          <div class="" >
              <img style="width: 100%; height: 100px"
               src="http://23.253.41.33/wp-content/uploads/10.208.149.45/uploads/2014/02/luzazul.jpeg"> 
          </div>
        </div>
       @endforeach
      </div>
    </div>
  </div>

</body>
</html>






<!-- Recursos javascript-ajax -->
<!-- <script src="{{asset('assets/js/recursos.js')}}"></script> -->
