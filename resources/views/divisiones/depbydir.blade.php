<label for="id_dir">Nombre de Dependencia</label>
<select name="id_dir" id="id_dir" class="form-control" placeholder="Seleccione la Dependencia">
<option value="00">Seleccione</option>
@foreach ($direccion as $dir)
<option value="{{$dir->id}}">{{$dir->descripcion}}</option>
@endforeach
</select>