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
        'id_dpt',
        'fecha_inicio',
        'fecha_fin'
       
        ];



    public static function guardar($data){
        $usuarioaprob=new UsuariosAprobadores;
        $usuarioaprob->id_usuario=$data['id_usuario'];
        $usuarioaprob->id_org=$data['id_org'];
        $usuarioaprob->id_dep=$data['id_dep'];
        $usuarioaprob->id_dir=$data['id_dir'];
        $usuarioaprob->id_div=$data['id_div'];
        $usuarioaprob->id_dpt=$data['id_dpt'];
        $usuarioaprob->fecha_inicio=$data['fecha_inicio'];
        $usuarioaprob->fecha_fin=$data['fecha_fin'];
      
        //$usuario->id_cargo=$data['id_cargo'];
        


        $usuario->save();

         if(!is_null($usuario)){
            return true;
         }else{
            return false;
         }        
    }

}
