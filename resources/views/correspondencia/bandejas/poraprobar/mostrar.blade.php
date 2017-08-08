<div class="row">
  <div id="paginacion">
    <div class="col-md-8 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-action">
        <div class="col s6">
          <b>Correspondencia Por Aprobar</b>
        </div>      
        <div class="input-field col s6">
             
        </div>
        </div>
        <table class="table">
          <thead>
            <th>Id</th>
            <th>Descripción</th>
            <th>Organismo</th>


        </thead>
        <tbody>
          @foreach($data as $correspondencia)
            <tr>
             {{var_dump($correspondencia)}}
              
            </tr>
          @endforeach

        </tbody>
        </table>


      </div>
    </div>
      <div class="col-md-4 col-sm-12 col-xs-12 edit">

      </div>
  </div>

</div>

<!-- Recursos javascript-ajax -->
<script src="{{asset('assets/js/recursos.js')}}"></script> 