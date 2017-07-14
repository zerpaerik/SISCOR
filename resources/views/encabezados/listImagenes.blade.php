<div class="row">
	<div id="paginacion">
		<div class="col-md-8 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<b>Lista de Encabezados</b>
				</div>			
				<div class="input-field col s6">
                  @include('encabezados.search')
				</div>
				</div>
				<table class="table">
					<thead>
						<th>Id</th>
						<th>Descripción</th>
						<th>Img Der</th>
						<th>Img Izq</th>

				</thead>
				<tbody>
					@foreach($data as $encabezado)
						<tr>
							<td>{{$encabezado->id}}</td>
							<td>{{$encabezado->descripcion}}</td>
							<td>{{$encabezado->pie}}</td>
							<td>{{$encabezado->encabezado}}</td>

							<td>
								<input type="button" 
							           class=" waves-effect waves-light btn actualizar" 
							           href="{{asset('encabezados/edit')}}/{{$encabezado->id}}" 
							           value="Actualizar"/>
							</td>
							<td>
								<input type="button" 
							           class="btn btn-danger eliminar" 
							           href="{{asset('encabezados/encabezado-modal')}}/{{$encabezado->id}}" 
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