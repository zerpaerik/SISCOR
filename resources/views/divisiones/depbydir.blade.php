<label for="id_dir">Nombre de Direccion</label>
<select name="id_dir" id="id_dir" class="form-control" placeholder="Seleccione la Dependencia">
<option value="00">Seleccione</option>
@foreach ($direccion as $dir)
<option value="{{$dir->id}}">{{$dir->descripcion}}</option>
@endforeach
</select>


<script type="text/javascript">
        $('#id_dir').on('change',function(){
          var id= $('#id_dir').val();
          var link= '{{asset("departamentos/dirbydiv/id")}}';
              link= link.replace('id',id);
          $.ajax({
                 type: "get",
                 url: link ,
                 success: function(a) {
                    $('#dirbydiv').html(a);
                 }
          });

        });
    </script>