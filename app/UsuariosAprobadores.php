<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;

class UsuariosAprobadores extends Model
{
    

	protected $table='tblusuariosaprob';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id_usuario',
        'id_org',
        'id_dep',
        'id_dir',
        'id_div',
        'fecha_inicio',
        'fecha_fin'
       
        ];

}
