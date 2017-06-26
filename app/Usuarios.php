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
        'cargo',
        'perfil',
        'tipo_usuario',
        'estatus'
        ];


    public static function login($data){
        $usuario = DB::table('tblusuarios')
                     ->where('usuario','=',$data['usuario'])
                     ->where('estatus','=','1')
                     ->first();

         if(!is_null($usuario)){
           // if (Hash::check($data['contrasena'],$usuario->contrasena)) {
               Session::put('id',$usuario->id);
               Session::put('nombre',$usuario->nombres." ".$usuario->apellidos);

               return true;
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

     public static function buscar($query){
   
        $usuario = DB::table('tblusuarios')
                     ->where('estatus','=','1')
                     ->where('nombres','ilike', "%$query%")
                     ->orderby('cedula')
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
        $usuario->cargo=$data['cargo'];
        $usuario->perfil=$data['perfil'];
        $usuario->tipo_usuario=$data['tipo_usuario'];
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
        $usuario->cargo=$data['cargo'];
        $usuario->perfil=$data['perfil'];
        $usuario->tipo_usuario=$data['tipo_usuario'];

       $usuario->update();

         if(!is_null($usuario)){
            return true;
         }else{
            return false;
         }        
    }


     public static function usrbyorg($id){
             $usuario = DB::table('tblusuarios as a')
                     ->where('a.estatus','=','1')
                     ->where('a.id_org','=', $id)
                     ->where('a.perfil','=','10')
                     ->get();
         if(!is_null($usuario)){
            return $usuario;
         }else{
            return false;
         }

    }
    

     public static function updatepasswd($id,$data){
        $usuario=Usuarios::findOrFail($id);
        $usuario->contrasena=$data['contrasena'];
       
        $usuario->update();

         if(!is_null($usuario)){
            return true;
         }else{
            return false;
         }        
    }

    public static function eliminar($id){
       $usuario=Usuarios::findOrFail($id);
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
