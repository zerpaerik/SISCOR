    <div class="row">
	    <div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="card">
    			<div class="card-action">
        			<b>¿Desea Cancelar?</b>
    			</div>
    			<div class="card-content">
				<form role="form" action="{{asset('correspondencia/destroy')}}/{{$correspondencia->id}}" id="destroy">
	  			<div class="form-group">
    			<label for="descripcion">Número de Correspondencia</label>
    			<input type="text" readonly class="form-control" 
        	           value="{{$correspondencia->id_correspondencia}}" >
  				</div>
  				<button type="submit" class=" waves-effect waves-light btn">Eliminar</button>
  				<button type="buton"  class=" btn-info btn cancelar">Cancelar</button>
				</form>
				</div>    		
    		</div>          
    	</div>
    </div>
    <!-- Recursos javascript-ajax --> 
    <script src="{{asset('assets/js/recursos.js')}}"></script> 

    <script type="text/javascript">
      

      function recargar(){
            	 $('#paginacion').empty();
            	 $.ajax({
                 	type: "get",
                	url: "{{ asset('/correspondencia/bandejas/archivadas/listArchivadas') }}",
                 	success: function(a) {
                    	$('#paginacion').html(a);
                 	}
              	 });
            }
    </script>