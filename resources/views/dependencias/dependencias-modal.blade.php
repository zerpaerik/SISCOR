    <div class="row">
	    <div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="card">
    			<div class="card-action">
        			<b>¿Desea Eliminar?</b>
    			</div>
    			<div class="card-content">
				<form role="form" action="{{asset('dependencias/destroy')}}/{{$dependencia->id}}" id="destroy">
	  			<div class="form-group">
    			<label for="descripcion">Nombre de la Dependencia</label>
    			<input type="text" readonly class="form-control" 
        	           value="{{$dependencia->descripcion}}" >
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
                	url: "{{ asset('/dependencias/listDependencias') }}",
                 	success: function(a) {
                    	$('#paginacion').html(a);
                 	}
              	 });
            }
    </script>

