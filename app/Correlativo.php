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
        'id_org' ,
        'id_dep',
        'id_tipo_correspondencia',
        'updated_at',
        'created_at'
        
        ];//
}
