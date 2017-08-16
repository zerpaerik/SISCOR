<div class="row">
	<div id="paginacion">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<b>Lista de Usuarios</b>
				</div>			
				<div class="input-field col s6">
                  @include('usuarios.search')
				</div>
				</div>
				<table class="table">
					<thead>
						<th>Cédula</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Usuario</th>

				</thead>
				<tbody>
					@foreach($data as $usuario)
						<tr>
							<td>{{$usuario->cedula}}</td>
							<td>{{$usuario->nombres}}</td>
							<td>{{$usuario->apellidos}}</td>
							<td>{{$usuario->usuario}}</td>

							<td>
								<input type="button" 
							           class=" waves-effect waves-light btn actualizar" 
							           href="{{asset('usuarios/edit')}}/{{$usuario->id}}" 
							           value="Actualizar"/>
							</td>
							<td>
								<input type="button" 
							           class="btn btn-danger eliminar" 
							           href="{{asset('usuarios/usuarios-modal')}}/{{$usuario->id}}" 
							           value="Eliminar"/>
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