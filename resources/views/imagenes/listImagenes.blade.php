<div class="row">
	<div id="paginacion">
		<div class="col-md-8 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<b>Lista de Imagenes</b>
				</div>			
				<div class="input-field col s6">
                  @include('imagenes.search')
				</div>
				</div>
				<table class="table">
					<thead>
						<th>Id</th>
						<th>Descripción</th>
						<th>Pie</th>
						<th>Encabezado</th>

				</thead>
				<tbody>
					@foreach($data as $imagenes)
						<tr>
							<td>{{$imagenes->id}}</td>
							<td>{{$imagenes->descripcion}}</td>
							<td>{{$imagenes->pie}}</td>
							<td>{{$imagenes->encabezado}}</td>

							<td>
								<input type="button" 
							           class=" waves-effect waves-light btn actualizar" 
							           href="{{asset('imagenes/edit')}}/{{$imagenes->id}}" 
							           value="Actualizar"/>
							</td>
							<td>
								<input type="button" 
							           class="btn btn-danger eliminar" 
							           href="{{asset('imagenes/dependenciamodal')}}/{{$imagenes->id}}" 
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