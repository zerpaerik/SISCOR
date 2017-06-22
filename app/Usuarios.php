<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Usuarios extends Model
{


	protected $table='tblusuarios';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id',
        'cedula',
        'nombres' ,
        'apellidos',
        'usuario',
        'contrasena',
        'iniciales' ,
        'id_org',
        'id_dep',
        'id_cargo',
        'estatus',
        'perfil'
        ];


    public static function login($data){
        $usuario = DB::table('tblusuarios')
                     ->where('usuario','=',$data['usuario'])
                     ->where('estatus','=','1')
                     ->first();

         if(!is_null($usuario)){
            if (Hash::check($data['contrasena'],$usuario->contrasena)) {
               Session::put('ID',$usuario->id);
               Session::put('NOMBRE',$usuario->nombre." ".$usuario->apellido);
               Session::put('PERFIL',$usuario->perfil);

               return true;
            }else{
               return false;
            }
         }else{
            return false;
         }        
    }

    public static function lista(){
        $usuario = DB::table('tblusuarios')
                     ->where('estatus','=','1')
                     ->paginate(5);

         if(!is_null($usuario)){
            return $usuario;
         }else{
            return false;
         }        
    }

    public static function guardar($data){
        $usuario=new Usuarios;
        $usuario->cedula=$data['cedula'];
        $usuario->nombres=$data['nombres'];
        $usuario->apellidos=$data['apellidos'];
        $usuario->usuario=$data['usuario'];
        $usuario->contrasena=$data['contrasena'];
        $usuario->iniciales=$data['iniciales'];
        $usuario->id_org=$data['id_org'];
        $usuario->id_dep=$data['id_dep'];
        $usuario->id_cargo=$data['id_org'];
        $usuario->perfil=$data['perfil'];
        //$usuario->id_cargo=$data['id_cargo'];
        


        $usuario->save();

         if(!is_null($usuario)){
            return true;
         }else{
            return false;
         }        
    }


    public static function actualizar($id,$data){
       $usuario=Usuarios::findOrFail($id);
        $usuario->cedula=$data['cedula'];
        $usuario->nombres=$data['nombres'];
        $usuario->apellidos=$data['apellidos'];
        $usuario->usuario=$data['usuario'];
        $usuario->contrasena=$data['contrasena'];
        $usuario->iniciales=$data['iniciales'];
        $usuario->id_org=$data['id_org'];
        $usuario->id_dep=$data['id_dep'];
        $usuario->id_cargo=$data['id_cargo'];
        $usuario->perfil=$data['perfil'];


       $usuario->update();

         if(!is_null($usuario)){
            return true;
         }else{
            return false;
         }        
    }

    public static function eliminar($id){
       $usuario=Usuario::findOrFail($id);
       $usuario->estatus='2';

       $usuario->update();

         if(!is_null($usuario)){
            return true;
         }else{
            return false;
         }        
    }
    //
}
