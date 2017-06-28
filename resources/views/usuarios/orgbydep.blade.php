<label for="id_dep">Nombre de Dependencia</label>
<select name="id_dep" id="id_dep" class="form-control" placeholder="Seleccione la Dependencia">
<option value="00">Seleccione</option>
@foreach ($dependencia as $dep)
<option value="{{$dep->id}}">{{$dep->descripcion}}</option>
@endforeach
</select>

 <script type="text/javascript">
        $('#id_dep').on('change',function(){
          var id= $('#id_dep').val();
          var link= '{{asset("divisiones/depbydir/id")}}';
              link= link.replace('id',id);
          $.ajax({
                 type: "get",
                 url: link ,
                 success: function(a) {
                    $('#depbydir').html(a);
                 }
          });

        });
    </script>