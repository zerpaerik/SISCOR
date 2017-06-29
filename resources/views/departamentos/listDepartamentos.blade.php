<div class="row">
	<div id="paginacion">
		<div class="col-md-8 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<b>Lista de Departamentos</b>
				</div>			
				<div class="input-field col s6">
                  @include('departamentos.search')
				</div>
				</div>
				<table class="table">
					<thead>
						<th>Id</th>
						<th>Descripción</th>
						<th>Organismo</th>
						<th>Dependencia</th>


				</thead>
				<tbody>
					@foreach($data as $departamento)
						<tr>
							<td>{{$departamento->id}}</td>
							<td>{{$departamento->descripcion}}</td>
							<td>{{$departamento->id_org}}</td>
						

							<td>
								<input type="button" 
							           class=" waves-effect waves-light btn actualizar" 
							           href="{{asset('departamentos/edit')}}/{{$departamento->id}}" 
							           value="Actualizar"/>
							</td>
							<td>
								<input type="button" 
							           class="btn btn-danger eliminar" 
							           href="{{asset('departamentos/departamentos-modal')}}/{{$departamento->id}}" 
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