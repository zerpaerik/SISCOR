<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;

class HistorialCorrespondencia extends Model
{

	protected $table='tblhistorialcorrespondencia';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id_correspondencia',
        'id_usuario',
        'id_estatus_correspondencia',
        'fecha',
        'emiorec'
        ];
    //
}
