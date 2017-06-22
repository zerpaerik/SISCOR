<div class="row">
	<div id="paginacion">
		<div class="col-md-8 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<b>Lista de Organismos</b>
				</div>			
				<div class="input-field col s6">
                  @include('organismos.search')
				</div>
				</div>
				<table class="table">
					<thead>
						<th>Id</th>
						<th>Descripción</th>
						<th>Siglas</th>
				</thead>
				<tbody>
					@foreach($data as $organismo)
						<tr>
							<td>{{$organismo->id}}</td>
							<td>{{$organismo->descripcion}}</td>
							<td>{{$organismo->siglas}}</td>
							<td>
								<input type="button" 
							           class=" waves-effect waves-light btn actualizar" 
							           href="{{asset('organismos/edit')}}/{{$organismo->id}}" 
							           value="Actualizar"/>
							</td>
							<td>
								<input type="button" 
							           class="btn btn-danger eliminar" 
							           href="{{asset('organismos/organismomodal')}}/{{$organismo->id}}" 
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