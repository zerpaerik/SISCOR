<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;

class DetalleCorrespondencia extends Model
{
    protected $table='tbldetallecorrespondencia';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id_correspondencia',
        'id_tipo_correspondencia',
        'id_tipo_confidencialidad',
        'ubic', 
        'asunto', 
        'contenido'
        ];
}
