<form action="{{asset('correspondencia/bandejas/asignadas/listAsignadas')}}" method="GET" autocomplete="off" role="search" id="Buscar">
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="" placeholder="Buscar..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>
</form>
