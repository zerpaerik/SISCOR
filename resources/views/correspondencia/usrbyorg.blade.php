<label for="id_destino">Destinatario</label>
<select name="id_destino" id="id_destino" class="form-control" placeholder="Seleccione el Destinatario">
<option value="00">Seleccione</option>
@foreach ($destinatario as $dest)
<option value="{{$dest->id}}">{{$dest->nombres}}{{$dest->apellidos}}</option>
@endforeach
</select>