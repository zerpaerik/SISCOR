<!DOCTYPE html>
<html lang="eng">
<head>
     
	<meta charset="UTF-8">
	<title>Listado de Correspondencias Enviadas</title>
	<link rel="stylesheet" type="text/css" href="assets/css/pdf.css">

</head>

<body>


		<h2><center>Listado de Correspondencias Enviadas</center></h2>

		<table>

			<thead>
				<tr>
					<th>Numero</th>
					<th>Asunto</th>
					<th>Emisor</th>
					<th>Fecha</th>
				</tr>

			</thead>
				<tbody>
				 @foreach($enviadas as $correspondencia)

						 <tr>
							 <td>{{ $correspondencia->id_correspondencia }}</td>
							 <td>{{ $correspondencia->asunto }}</td>
							 <td>{{ $correspondencia->descripcion }}</td>
							 <td>{{date("d-m-Y g:i A",strtotime($correspondencia->fecha_recepcion))}}</td>
						 </tr>

		          @endforeach
				</tbody>
		</table>
			

</body>


</html>
