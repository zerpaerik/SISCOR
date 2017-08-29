<div class="row">
	<div id="paginacion">
		<div class="col-md-8 col-sm-8 col-xs-8">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<b3>Reportes Generales</b3>
				</div>			
				<div class="input-field col s6">
				</div>
				</div>
				<table class="table">
					<thead>
						<th>Id</th>
						<th>Reporte</th>
						<th>Ver</th>
						<th>Descargar</th>
						

				</thead>
				<tbody>
					
						<tr>
							<td>1</td>
							<td>Correspondencias Enviadas</td>
				
							 <td>
                                <a href="{{asset('listado_enviadas_ver')}}" class=" waves-effect waves-light btn" target="_blank">Ver</a>
                            </td>

                              <td>
                                <a href="{{asset('listado_enviadas_descargar')}}" class=" waves-effect waves-light btn">Descargar</a>
                            </td>

						</tr>

							<tr>
							<td>2</td>
							<td>Correspondencias Recibidas</td>
				
							<td>
                                <a href="{{asset('listado_recibidas_ver')}}" class=" waves-effect waves-light btn" target="_blank">Ver</a>
                            </td>

                              <td>
                                <a href="{{asset('listado_recibidas_descargar')}}" class=" waves-effect waves-light btn">Descargar</a>
                            </td>

						</tr>
					

				</tbody>
				</table>
			
			</div>
		</div>
			<div class="col-md-8 col-sm-8 col-xs-8 edit">

			</div>
	</div>

</div>

<!-- Recursos javascript-ajax -->
