<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use SISCOR\UsuariosAprobadores;

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
        'id_dir',
        'id_div',
        'cargo',
        'perfil',
        'tipo_usuario',
        'aprobador'
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

    public static function guardar($data,$data1)

            DB::beginTransaction();
        //todas tus implementaciones con sus funciones a modelo
        try {
                  $data=Input::get('cedula'),
                  $data=Input::get('nombres'),
                  $data=Input::get('apellidos'),
                  $data=Input::get('usuario'),
                  $data=Input::get('contrasena'),
                  $data=Input::get('iniciales'),
                  $data=Input::get('id_org'),
                  $data=Input::get('id_dep'),
                  $data=Input::get('id_dir'),
                  $data=Input::get('id_div'),
                  $data=Input::get('cargo'),
                  $data=Input::get('perfil'),
                  $data=Input::get('tipo_usuario'),
                  $data=Input::get('aprobador')
                
                
                $guardar=Usuarios::save($data);

                $data1= array(                      

                             $data1->id_usuario=$usuario->id;
                             $data1->id_org=$usuario->id_org;
                             $data1->id_dep=$usuario->id_dep;
                             $data1->id_dir=$usuario->id_dir;
                             $data1->id_div=$usuario->id_div;

                             )

                $guardar2=UsuariosAprobadores::save($data1);
 }
        // Ha ocurrido un error, devolvemos la BD a su estado previo y hacemos lo que queramos con esa excepción
        catch (\Exception $e)
        {
                DB::rollback();
                // no se... Informemos con un echo por ejemplo
                echo 'ERROR (' . $e->getCode() . '): ' . $e->getMessage();
        }

        // Hacemos los cambios permanentes ya que no han habido errores
        DB::commit();




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
        $usuario->id_dir=$data['id_dir'];
        $usuario->id_div=$data['id_div'];
        $usuario->cargo=$data['cargo'];
        $usuario->perfil=$data['perfil'];
        $usuario->tipo_usuario=$data['tipo_usuario'];
        $usuario->aprobador=$data['aprobador'];

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
