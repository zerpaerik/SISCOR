<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;

class Emision extends Model
{

	protected $table='tblemision';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id_correspondencia',
        'id_org_emisor',
        'id_dep_emisor',
        'id_tipo_correspondencia',
        'id_usuario_emisor',
        'id_usuario_aprobador',
        'fecha_emision',
        'id_estatus_emision'
        ];
    //
}
