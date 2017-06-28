<label for="id_div">Nombre de Division</label>
<select name="id_div" id="id_div" class="form-control" placeholder="Seleccione la Division">
<option value="00">Seleccione</option>
@foreach ($division as $div)
<option value="{{$div->id}}">{{$div->descripcion}}</option>
@endforeach
</select>