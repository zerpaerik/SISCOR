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
       @foreach($enviadas as $correspondencia)
        <div class="panel ">
          <img style="width: 100%; height: 70px"
               src="http://23.253.41.33/wp-content/uploads/10.208.149.45/uploads/2014/02/luzazul.jpeg"> 
          <div class="panel-heading">
           
            <div class="row"><!--un row es una fila-->
                <div class="pull-right"><b>San Juan de los Morros,</b> &nbsp;</div>
            </div> <br></br>
           
            <div class="row">
                <div class="pull-right">{{date("d-m-Y g:i A",strtotime($correspondencia->fecha_emision))}}  &nbsp;</div> <br></br> <br></br>
            </div> <br></br> <br></br>

            <div class="row">
                <div>&nbsp;<b>OFICIO:</b> {{$correspondencia->id_correspondencia}}</div>
            </div>
            <div class="row">
                <div>&nbsp;<b>CIUDADANO:</b></div>
            </div>
            <div class="row">
                <div>&nbsp; {{$correspondencia->descripcion}}</div>
            </div>
            <div class="row">
                <div>&nbsp;<b>DEPENDENCIA:</b> {{$correspondencia->descripcion}}</div>
            </div>
            <div class="row">
                <div >&nbsp;<b>SU DESPACHO.-</b></div>
            </div>
          </div> <br></br> 
         
          <div class="panel-body" id="contenido">
             {{$correspondencia->contenido}}
          </div> <br></br> <br></br> <br></br> <br></br> <br></br> <br></br> <br></br> <br></br> <br></br> <br></br> <br></br> <br></br> <br></br> <br></br> <br></br> <br></br> 
          <div class="row">
                <center><div>&nbsp;<b></b> {{$correspondencia->nombres}} {{$correspondencia->apellidos}}</div></center>
            </div>
             <div class="row">
                <center><div>&nbsp; {{$correspondencia->cargo}}</div></center>
            </div> <br></br> <br></br> 
          <div class="row">
                <div>&nbsp; {{$correspondencia->iniciales}}<b>/</b></div>
            </div>
          <div class="" >
              <img style="width: 100%; height: 70px"
               src="http://23.253.41.33/wp-content/uploads/10.208.149.45/uploads/2014/02/luzazul.jpeg"> 
          </div>
        </div>
       @endforeach
      </div>
    </div>
  </div>

</body>
</html>
