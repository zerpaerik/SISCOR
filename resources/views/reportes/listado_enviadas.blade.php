<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<div class="row">
	<div id="paginacion">
		<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="box-header with-border"
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<b>Listado de Correspondencias Enviadas</b>
				</div>			
				<div class="input-field col s6">

				</div>
				</div>
				<table class="table">
					<thead>
						<th>Número</th>
						<th>Asunto</th>
						<th>Emisor</th>
						<th>Fecha</th>
						

				</thead>
				<tbody>
					@foreach($enviadas as $correspondencia)
						<tr>
							<td>{{$correspondencia->id_correspondencia}}</td>
							<td>{{$correspondencia->asunto}}</td>
							<td>{{$correspondencia->descripcion}}</td>
							<td>{{date("d-m-Y g:i A",strtotime($correspondencia->fecha_recepcion))}}</td>
				
							 <td>
                               
                            </td>

						</tr>
					@endforeach

				</tbody>
				</table>

			
			</div>
		</div>
		</div>
			<div class="col-md-12 col-sm-12 col-xs-12 edit">

			</div>
	</div>

</div>

<!-- Recursos javascript-ajax -->
<script src="{{asset('assets/js/recursos.js')}}"></script> 