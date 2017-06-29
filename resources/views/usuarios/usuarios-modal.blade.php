    <div class="row">
	    <div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="card">
    			<div class="card-action">
        			<b>¿Desea Eliminar?</b>
    			</div>
    			<div class="card-content">
				<form role="form" action="{{asset('usuarios/destroy')}}/{{$usuario->id}}" id="destroy">
	  			<div class="form-group">
    			<label for="nombres">Nombre del Usuario</label>
    			<input type="text" readonly class="form-control" 
        	           value="{{$usuario->nombres}}" >
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
                	url: "{{ asset('/usuarios/listUsuarios') }}",
                 	success: function(a) {
                    	$('#paginacion').html(a);
                 	}
              	 });
            }
    </script>
