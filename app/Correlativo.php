<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;

class Correlativo extends Model
{
    
    protected $table='tblcorrelativo';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'contador',
        'fecha',
        'id_org' ,
        'id_dep',
        'id_tipo_correspondencia'
        
        ];//
}
