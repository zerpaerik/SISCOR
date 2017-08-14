<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;

class RechazaCorrespondencia extends Model
{
	protected $table='tblrechazacorrespondencia';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id_correspondencia',
        'descripcion',
        'id_usuario_rechaza',
        'id_usuario_recibe'
        ];
    //
}
