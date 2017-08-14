<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;

class AsignaCorrespondencia extends Model
{

	protected $table='tblasignacorrespondencia';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id_recepcion_correspondencia',
        'id_usuario_asigna',
        'id_usuario_asignado',
        'id_instruccion',
        'comentario'
        ];
    //
}
