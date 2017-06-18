<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$location->id}}">
<form action="{{asset('location/destroy')}}/{{$location->id}}" method="delete">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3>¿Desea Eliminar?</h3>
					<button type="button" aria-label="close" class="close" data-dismiss="modal">
					<span aria-hidden="true"></span>
					</button>
				</div>
				<div class="modal-body">

					<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary" >Confirmar</button>
				</div>
			</div>
		</div>
</form>
	
</div>