   <div class="row">
                <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Asignar Correspondencia</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="id">Destinatario</label>
                  <select name="id" id="id" class="form-control" placeholder="Seleccione el Destinatario">
                    <option value="00">Seleccione</option>
                    @foreach ($destinatario as $dest)
                      <option value="{{$dest->id}}">{{$dest->nombres}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="ubic">Instrucción</label>
                  <select name="ubic" id="ubic" class="form-control" placeholder="Seleccione la Instrucción">
                    <option value="00">Seleccione</option>
                    <option value="10">Elaborar Respuesta</option>
                    <option value="20">Notificar</option>
                    <option value="20">Asistir</option>
                    <option value="20">Reasignar</option>
                    <option value="20">Confirmar</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="comment">Comentario:</label>
                  <textarea class="form-control" rows="5" id="comment"></textarea>
              </div> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="waves-effect waves-light btn" data-dismiss="modal">Guardar</button>
          <button type="reset"  class="btn btn-info" data-dismiss="modal">Limpiar</button>
        </div>
        
      </div>
      
    </div>
  </div>
  </div>