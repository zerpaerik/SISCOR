<div class="row">
	<div id="paginacion">
		<div class="col-md-8 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<b>Correspondencias Recibidas</b>
				</div>			
				<div class="input-field col s6">
                  @include('correspondencia.bandejas.recibidas.search')
				</div>
				</div>
				<table class="table">
					<thead>
					    <th>Tipo de Correspondencia</th>
						<th>Número</th>
						<th>Asunto</th>
						<th>Org Emisor</th>

				</thead>
				<tbody>
					@foreach($data as $correspondencia)
						<tr>
							<td>{{$correspondencia->id_tipo_correspondencia}}</td>
							<td>{{$correspondencia->id_correspondencia}}</td>
							<td>{{$correspondencia->asunto}}</td>
							<td>{{$correspondencia->id_org}}</td>
             
							<td>
								<input type="button" 
							           class="btn btn-danger eliminar" 
							           href="{{asset('correspondencia/bandejas/recibidas/recibidas-modal')}}/{{$correspondencia->id}}" 
							           value="Cancelar"/>
							</td>
						</tr>
					@endforeach

				</tbody>
				</table>

				{{ $data->appends(array('searchText' => $searchText))->links() }}

			</div>
		</div>
			<div class="col-md-4 col-sm-12 col-xs-12 edit">

			</div>
	</div>

</div>

<!-- Recursos javascript-ajax -->
<script src="{{asset('assets/js/recursos.js')}}"></script> 