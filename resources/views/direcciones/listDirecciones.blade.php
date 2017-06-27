<div class="row">
	<div id="paginacion">
		<div class="col-md-8 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<b>Lista de Direcciones</b>
				</div>			
				<div class="input-field col s6">
                  @include('direcciones.search')
				</div>
				</div>
				<table class="table">
					<thead>
						<th>Id</th>
						<th>Descripción</th>
						<th>Organismo</th>


				</thead>
				<tbody>
					@foreach($data as $direccion)
						<tr>
							<td>{{$direccion->id}}</td>
							<td>{{$direccion->descripcion}}</td>
							<td>{{$direccion->id_org}}</td>

							<td>
								<input type="button" 
							           class=" waves-effect waves-light btn actualizar" 
							           href="{{asset('direcciones/edit')}}/{{$direccion->id}}" 
							           value="Actualizar"/>
							</td>
							<td>
								<input type="button" 
							           class="btn btn-danger eliminar" 
							           href="{{asset('direcciones/direcciones-modal')}}/{{$direccion->id}}" 
							           value="Eliminar"/>
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