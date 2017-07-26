<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{

	protected $table='tblrecepcion';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id_correspondencia',
        'id_org_receptor',
        'id_dep_receptor',
        'id_estatus_recepcion'

        ];
    //
}
