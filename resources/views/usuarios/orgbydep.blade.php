<label for="id_dep">Nombre de Dependencia</label>
<select name="id_dep" id="id_dep" class="form-control" placeholder="Seleccione la Dependencia">
<option value="00">Seleccione</option>
@foreach ($dependencia as $dep)
<option value="{{$dep->id}}">{{$dep->descripcion}}</option>
@endforeach
</select>