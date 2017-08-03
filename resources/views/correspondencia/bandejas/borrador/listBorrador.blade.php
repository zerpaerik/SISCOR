<div class="row">
	<div id="paginacion">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<b>Correspondencias en Borrador</b>
				</div>			
				<div class="input-field col s6">
                  @include('correspondencia.bandejas.borrador.search')
				</div>
				</div>
				<table class="table">
					<thead>
						<th>Borrador</th>
						<th>Asunto</th>
						<th>Receptor</th>
						<th>Fecha</th>
						

				</thead>
				<tbody>
					@foreach($data as $correspondencia)
						<tr>
							<td>{{$correspondencia->id_correspondencia}}</td>
							<td>{{$correspondencia->asunto}}</td>
							<td>{{$correspondencia->descripcion}}</td>
							<td>{{$correspondencia->fecha_emision}}</td>
							
							<td>
								<input type="button" 
							           class=" waves-effect waves-light btn actualizar" 
							           href="{{asset('correspondencia/bandejas/borrador/borradores-modal')}}/{{$correspondencia->id_correspondencia}}"  
							           value="Ver"/>
							</td>

						</tr>
					@endforeach

				</tbody>
				</table>

                
                {{ $data->appends(array('searchText' => $searchText))->links() }}
			
			</div>
		</div>
			<div class="col-md-12 col-sm-12 col-xs-12 edit">

			</div>
	</div>

</div>

<!-- Recursos javascript-ajax -->
<script src="{{asset('assets/js/recursos.js')}}"></script> 