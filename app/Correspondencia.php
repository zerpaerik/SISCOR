<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use SISCOR\UsuariosAprobadores;
use SISCOR\Usuarios;
use SISCOR\Correlativo;
use SISCOR\Emision;
use SISCOR\Recepcion;

class Correspondencia extends Model
{
    protected $table='tblcorrespondencia';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id_correspondencia'
        ];

  
    public static function buscar($query){
 
        $correspondencia = DB::table('tblcorrespondencia')
                     ->where('id_correspondencia','ilike', "%$query%")
                     ->orderby('id_correspondencia')
                     ->paginate(5);

         if(!is_null($correspondencia)){
            return $correspondencia;
         }else{
            return false;
         }      
    }


     public static function guardar($data){
       
           try {
            DB::beginTransaction();
             $id_usuario=Session::get('id');
             $tipo = $data['id_tipo_correspondencia'];
             $id_tipo_correspondencia = $data['id_tipo_correspondencia'];
             $usuarioOrg = $data['id_org'];
             $usuarioDep = $data['id_dep'];
             $id_org = $data['id_org'];
             $id_dep = $data['id_dep'];
            // $adjunto = $data['adjunto'];

             $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }


            If (Correspondencia::esAprobador()){
            
            $id_estatus_correspondencia=7;
            $adjunto = $data['adjunto'];

            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarId($usuarioOrg,$usuarioDep,$tipo);
            $correspondencia->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $detalle = New DetalleCorrespondencia;
            $detalle->id_correspondencia =$correspondencia->id;
            $detalle->id_tipo_confidencialidad=$data['confidencialidad'];
            $detalle->id_tipo_correspondencia=$data['id_tipo_correspondencia'];
            $detalle->asunto=$data['asunto'];
            $detalle->ubic=$data['ubic'];
            $detalle->contenido=$data['contenido'];
            $detalle->save();


            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id;
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->id_estatus_emision='6';
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$emision->id_estatus_emision);
            Correspondencia::guardarAdjunto($correspondencia->id,$adjunto);


            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id;
            $recepcion->id_org_receptor = $id_org;
            $recepcion->id_dep_receptor = $id_dep;
            $recepcion->id_estatus_recepcion ='1';
            $recepcion->save();
            $id_estatus_correspondencia=1;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);


        } else {

        
            $id_estatus_correspondencia=7;
            $adjunto = $data['adjunto'];
            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarId($usuarioOrg,$usuarioDep,$tipo);
            $correspondencia->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $detalle = New DetalleCorrespondencia;
            $detalle->id_correspondencia =$correspondencia->id;
            $detalle->id_tipo_confidencialidad=$data['confidencialidad'];
            $detalle->id_tipo_correspondencia=$data['id_tipo_correspondencia'];
            $detalle->asunto=$data['asunto'];
            $detalle->ubic=$data['ubic'];
            $detalle->contenido=$data['contenido'];
            $detalle->save();

            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id;
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_estatus_emision='3';
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$emision->id_estatus_emision);
            Correspondencia::guardarAdjunto($correspondencia->id,$adjunto);

  
            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id;
            $recepcion->id_org_receptor = $id_org;
            $recepcion->id_dep_receptor = $id_dep;
            $recepcion->id_estatus_recepcion ='3';
            $recepcion->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

        }
             
            DB::commit();
        }catch (\Exception $e) { //esto atrapa cualquier error y devuelve false al controller
            DB::rollback();
            echo $e->getMessage(); die(); //para probar si hay error
            return false;
        }
        return true;

     }


     public static function guardarBorrador($data){
       
           try {
            DB::beginTransaction();
             $id_usuario=Session::get('id');
             $tipo = $data['id_tipo_correspondencia'];
             $id_tipo_correspondencia = $data['id_tipo_correspondencia'];
             $usuarioOrg = $data['id_org'];
             $usuarioDep = $data['id_dep'];
             $id_org = $data['id_org'];
             $id_dep = $data['id_dep'];
             $adjunto = $data['adjunto'];

             $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }


            If (Correspondencia::esAprobador()){
            $id_tipo_correlativo=2;
            $id_estatus_correspondencia=8;
            $adjunto = $data['adjunto'];
            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarIdBorrador($usuarioOrg,$usuarioDep,$tipo,$id_tipo_correlativo);
            $correspondencia->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $detalle = New DetalleCorrespondencia;
            $detalle->id_correspondencia =$correspondencia->id;
            $detalle->id_tipo_confidencialidad=$data['confidencialidad'];
            $detalle->id_tipo_correspondencia=$data['id_tipo_correspondencia'];
            $detalle->asunto=$data['asunto'];
            $detalle->ubic=$data['ubic'];
            $detalle->contenido=$data['contenido'];
            $detalle->save();

            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id;
           // $emision->id_org_emisor     =$data['id_org']; 
            //$emision->id_dep_emisor     =$data['id_dep']; 
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->id_estatus_emision='8';
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$emision->id_estatus_emision);
            Correspondencia::guardarAdjunto($correspondencia->id,$adjunto);


            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id;
            $recepcion->id_org_receptor = $id_org;
            $recepcion->id_dep_receptor = $id_dep;
            $recepcion->id_estatus_recepcion ='8';
            $recepcion->save();
            $id_estatus_correspondencia=8;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);


        } else {

        
           $id_estatus_correspondencia=8;
            $adjunto = $data['adjunto'];
            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarIdBorrador($usuarioOrg,$usuarioDep,$id_tipo_correlativo,$tipo);
            $correspondencia->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $detalle = New DetalleCorrespondencia;
            $detalle->id_correspondencia =$correspondencia->id;
            $detalle->id_tipo_confidencialidad=$data['confidencialidad'];
            $detalle->id_tipo_correspondencia=$data['id_tipo_correspondencia'];
            $detalle->asunto=$data['asunto'];
            $detalle->ubic=$data['ubic'];
            $detalle->contenido=$data['contenido'];
            $detalle->save();

            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id;
           // $emision->id_org_emisor     =$data['id_org']; 
            //$emision->id_dep_emisor     =$data['id_dep']; 
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->id_estatus_emision='8';
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$emision->id_estatus_emision);
            Correspondencia::guardarAdjunto($correspondencia->id,$adjunto);


            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id;
            $recepcion->id_org_receptor = $id_org;
            $recepcion->id_dep_receptor = $id_dep;
            $recepcion->id_estatus_recepcion ='8';
            $recepcion->save();
            $id_estatus_correspondencia=8;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);
        }
             
            DB::commit();
        }catch (\Exception $e) { //esto atrapa cualquier error y devuelve false al controller
            DB::rollback();
            echo $e->getMessage(); die(); //para probar si hay error
            return false;
        }
        return true;

     }

         

    public static function mostrarCorrespondencia($id){

        $correspondencia = DB::table('tblcorrespondencia as a ')
                    ->select('a.id','a.id_correspondencia','f.asunto','f.contenido','b.fecha_emision','d.descripcion','e.descripcion')
                    ->join('tblemision as b','a.id','b.id_correspondencia')
                    ->join('tblrecepcion as c','a.id','c.id_correspondencia')
                    ->join('tblorganismo as d','c.id_org_receptor','d.id')
                    ->join('tbldependencia as e','c.id_dep_receptor','e.id')
                    ->join('tbldetallecorrespondencia as f','a.id','f.id_correspondencia')
                    //->join('tblrechazacorrespondencia as g','a.id','g.id_correspondencia')
                    //->join('tblasignacorrespondencia as g','a.id','g.id_correspondencia')
                    ->where('a.id_correspondencia','=', $id)
                    ->get();            

         if(!is_null($correspondencia)){
            return $correspondencia;
         }else{
            return false;
         }  

    }


    public static function mostrarCorrespondenciaAsignada($id){

       $correspondencia = DB::table('tblcorrespondencia as a ')
                    ->select('a.id','a.id_correspondencia','f.asunto','f.contenido','b.fecha_emision','e.descripcion','g.comentario','h.instruccion')
                    ->join('tblemision as b','a.id','b.id_correspondencia')
                    ->join('tblrecepcion as c','a.id','c.id_correspondencia')
                    ->join('tblorganismo as d','c.id_org_receptor','d.id')
                    ->join('tbldependencia as e','c.id_dep_receptor','e.id')
                    ->join('tbldetallecorrespondencia as f','a.id','f.id_correspondencia')
                    ->join('tblasignacorrespondencia as g','a.id','g.id_correspondencia')
                    ->join('tblinstrucciones as h','h.id','g.id_instruccion')
                    ->where('a.id_correspondencia','=', $id)
                    ->get();          

         if(!is_null($correspondencia)){
            return $correspondencia;
         }else{
            return false;
         }  

    }

    public static function reporteListadoEnviadas(){

    $id_usuario=Session::get('id');
       
       
        $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }

      $enviadas = DB::table('tblcorrespondencia as a')
                 ->select('a.id','a.id_correspondencia','b.id_dep_receptor','b.fecha_recepcion','c.fecha_emision','e.descripcion','d.asunto')
                 ->join('tblrecepcion as b','a.id','b.id_correspondencia')
                 ->join('tblemision as c','a.id','c.id_correspondencia')
                 ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
                 ->join('tbldependencia as e','b.id_dep_receptor','e.id')
                 ->where('id_org_emisor','=',$usuarioOrg)
                 ->where('id_dep_emisor','=',$usuarioDep)
                 ->where('id_estatus_emision','=','6')
                 ->orderby('id_correspondencia')
                 ->get();     

        
        if(!is_null($enviadas)){
            return $enviadas;
         }else{
            return false;
         }

    }

    public static function mostrarCorrespondenciaRechazada($id){

       $correspondencia = DB::table('tblcorrespondencia as a ')
                    ->select('a.id','a.id_correspondencia','f.asunto','f.contenido','b.fecha_emision','d.descripcion','e.descripcion','g.comentario')
                    ->join('tblemision as b','a.id','b.id_correspondencia')
                    ->join('tblrecepcion as c','a.id','c.id_correspondencia')
                    ->join('tblorganismo as d','c.id_org_receptor','d.id')
                    ->join('tbldependencia as e','c.id_dep_receptor','e.id')
                    ->join('tbldetallecorrespondencia as f','a.id','f.id_correspondencia')
                    ->join('tblrechazacorrespondencia as g','a.id','g.id_correspondencia')
                    //->join('tblasignacorrespondencia as g','a.id','g.id_correspondencia')
                    ->where('a.id_correspondencia','=', $id)
                    ->get();          

         if(!is_null($correspondencia)){
            return $correspondencia;
         }else{
            return false;
         }  

    }



     
    public static function esAprobador(){

        $searchUsuarioAprobador = DB::table('tblusuariosaprob')
                    ->select('*')
                    ->where('id_usuario','=',Session::get('id'))
                    ->where('estatus','=','1')
                    ->get();

           if (count($searchUsuarioAprobador) > 0){

              return true;
           } else {

              return false;
           }
    } 



    public static function guardarAdjunto($id_correspondencia,$adjunto){

         $adjuntos = new Adjunto;
         $adjuntos->id_correspondencia=$id_correspondencia;
         $adjuntos->adjunto=$adjunto;
         $adjuntos->save();

    }

    public static function historialCorrespondencia($id_usuario,$id_correspondencia,$id_estatus_correspondencia){

          $historial = new HistorialCorrespondencia;
          $historial->id_correspondencia=$id_correspondencia;
          $historial->id_usuario=$id_usuario;
          $historial->id_estatus_correspondencia=$id_estatus_correspondencia;
          $historial->save();
         
    }

     //// Metodo para consultar correspondencias en la bandeja de recibidas //////
    public static function bandejaRecibidas(){
        
        ///// Primero verifico el id_org y el id_dep del usuario logueado ///////
        $id_usuario=Session::get('id');
       
       
        $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }
        
        If (Correspondencia::esAprobador()){  ///// si el usuario es aprobador consulta las corresp recibidas, estatus 1 en la tabla tblrecepcion
         

            $recibidas = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','c.id_org_receptor','c.id_dep_receptor','c.fecha_recepcion','d.asunto','e.descripcion','b.id_dep_emisor')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','1')
            ->orderby('c.fecha_recepcion')
            ->paginate(5);  
        
        
        if(!is_null($recibidas)){
            return $recibidas;
         }else{
            return false;
         }
     } else { //// sino es aprobador consulta las que están asignadas o pendientes por aprobar, estatus 3 en la tabla tblrecepcion

       
            $recibidas = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','c.id_org_receptor','c.id_dep_receptor','c.fecha_recepcion','d.asunto','e.descripcion','b.id_dep_emisor')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','9')
            ->orderby('id_correspondencia')
            ->paginate(5);  
        
        
        if(!is_null($recibidas)){
            return $recibidas;
         }else{
            return false;
         }


     }
    }

     public static function bandejaAsignadas(){
        
        ///// Primero verifico el id_org y el id_dep del usuario logueado ///////
        $id_usuario=Session::get('id');
       
       
        $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }
        
        If (Correspondencia::esAprobador()){  ///// si el usuario es aprobador consulta las corresp recibidas, estatus 1 en la tabla tblrecepcion
         

            $asignadas = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','c.id_org_receptor','c.id_dep_receptor','c.fecha_recepcion','d.asunto','e.descripcion','b.id_dep_emisor','d.id_tipo_correspondencia')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','4')
            ->orderby('id_correspondencia')
            ->paginate(5);  
        
        
        if(!is_null($asignadas)){
            return $asignadas;
         }else{
            return false;
         }
     } else { //// sino es aprobador consulta las que están asignadas o pendientes por aprobar, estatus 3 en la tabla tblrecepcion

         $asignadas = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','c.id_org_receptor','c.id_dep_receptor','c.fecha_recepcion','d.asunto','e.descripcion','b.id_dep_emisor','d.id_tipo_correspondencia')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','4')
            ->orderby('id_correspondencia')
            ->paginate(5); 
        
        
        if(!is_null($asignadas)){
            return $asignadas;
         }else{
            return false;
         }
     }
    }

    public static function bandejaRechazadas(){
        
        ///// Primero verifico el id_org y el id_dep del usuario logueado ///////
        $id_usuario=Session::get('id');
       
       
        $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }
        
        If (Correspondencia::esAprobador()){  ///// si el usuario es aprobador consulta las corresp recibidas, estatus 1 en la tabla tblrecepcion
         

            $rechazadas = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','c.id_org_receptor','c.id_dep_receptor','c.fecha_recepcion','d.asunto','e.descripcion','b.id_dep_emisor','c.id_estatus_recepcion')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->join('tblrechazacorrespondencia as f','a.id','f.id_correspondencia')
            //->where('id_org_receptor','=',$usuarioOrg)
            //->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','5')
            ->orderby('fecha_recepcion')
            ->paginate(5);  
        
        
        if(!is_null($rechazadas)){
            return $rechazadas;
         }else{
            return false;
         }
     } else { //// sino es aprobador consulta las que están asignadas o pendientes por aprobar, estatus 3 en la tabla tblrecepcion

         $rechazadas = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','c.id_org_receptor','c.id_dep_receptor','c.fecha_recepcion','d.asunto','e.descripcion','b.id_dep_emisor')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','5')
            ->orderby('fecha_recepcion')
            ->paginate(5); 
        
        
        if(!is_null($rechazadas)){
            return $rechazadas;
         }else{
            return false;
         }
     }
    }

    public static function bandejaEnviadas(){

         $id_usuario=Session::get('id');
       
        $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }


                  If (Correspondencia::esAprobador()){  ///// si el usuario es aprobador consulta las corresp enviadas, estatus 6 en la tabla tblrecepcion
         

        /* $enviadas = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_emision','=','6')
            ->orderby('id_correspondencia')
            ->paginate(5);*/


             $enviadas = DB::table('tblcorrespondencia as a')
                 ->select('a.id','a.id_correspondencia','b.id_dep_receptor','c.fecha_emision','e.descripcion','d.asunto')
                 ->join('tblrecepcion as b','a.id','b.id_correspondencia')
                 ->join('tblemision as c','a.id','c.id_correspondencia')
                 ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
                 ->join('tbldependencia as e','b.id_dep_receptor','e.id')
                 ->where('id_org_emisor','=',$usuarioOrg)
                 ->where('id_dep_emisor','=',$usuarioDep)
                 ->where('id_estatus_emision','=','6')
                 ->orderby('id_correspondencia')
                 ->paginate(5);     

        
        if(!is_null($enviadas)){
            return $enviadas;
         }else{
            return false;
         }
     } else { //// sino es aprobador consulta las que están asignadas o pendientes por aprobar, estatus 3 en la tabla tblrecepcion

         $enviadas = DB::table('tblcorrespondencia as a')
                 ->select('a.id','a.id_correspondencia','b.id_dep_receptor','c.fecha_emision','e.descripcion','d.asunto')
                 ->join('tblrecepcion as b','a.id','b.id_correspondencia')
                 ->join('tblemision as c','a.id','c.id_correspondencia')
                 ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
                 ->join('tbldependencia as e','b.id_dep_receptor','e.id')
                 ->where('id_org_emisor','=',$usuarioOrg)
                 ->where('id_dep_emisor','=',$usuarioDep)
                 ->where('id_estatus_emision','=','6')
                 ->orderby('id_correspondencia')
                 ->paginate(5);  
        
        
        if(!is_null($enviadas)){
            return $enviadas;
         }else{
            return false;
         }
     }

    }


    public static function bandejaporAprobar(){

      $id_usuario=Session::get('id');
       
        $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }


                  If (Correspondencia::esAprobador()){  ///// si el usuario es aprobador consulta las corresp enviadas, estatus 6 en la tabla tblrecepcion
         

        /* $poraprobar = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_emision','=','3')
            ->orderby('id_correspondencia')
            ->paginate(5);
        */
            $poraprobar = DB::table('tblcorrespondencia as a')
             ->select('a.id','a.id_correspondencia','b.fecha_emision','c.id_dep_receptor','d.asunto','d.contenido','e.descripcion')  
             ->join('tblemision as b','a.id','b.id_correspondencia')
             ->join('tblrecepcion as c','a.id','c.id_correspondencia')
             ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
             ->join('tbldependencia as e','c.id_dep_receptor','e.id')
             ->where('id_org_emisor','=',$usuarioOrg)
             ->where('id_dep_emisor','=',$usuarioDep)
             ->where('id_estatus_emision','=','3')
             ->orderby('id_correspondencia')
             ->paginate(5);    
        
        if(!is_null($poraprobar)){
            return $poraprobar;
         }else{
            return false;
         }
     } else { //// sino es aprobador consulta las que están asignadas o pendientes por aprobar, estatus 3 en la tabla tblrecepcion

         /*$poraprobar = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','3')
            ->orderby('id_correspondencia')
            ->paginate(5);*/

            $poraprobar = DB::table('tblcorrespondencia as a')
             ->select('a.id','a.id_correspondencia','b.fecha_emision','c.id_dep_receptor','d.asunto','d.contenido','e.descripcion')  
             ->join('tblemision as b','a.id','b.id_correspondencia')
             ->join('tblrecepcion as c','a.id','c.id_correspondencia')
             ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
             ->join('tbldependencia as e','c.id_dep_receptor','e.id')
             ->where('id_org_emisor','=',$usuarioOrg)
             ->where('id_dep_emisor','=',$usuarioDep)
             ->where('id_estatus_emision','=','3')
             ->orderby('id_correspondencia')
             ->paginate(5);   
        
        
        if(!is_null($poraprobar)){
            return $poraprobar;
         }else{
            return false;
         }
     }
    }


    public static function bandejaBorrador(){

         $id_usuario=Session::get('id');
       
        $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }


                  If (Correspondencia::esAprobador()){  ///// si el usuario es aprobador consulta las corresp enviadas, estatus 6 en la tabla tblrecepcion
         

         /*$borradores = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_emision','=','8')
            ->orderby('id_correspondencia')
            ->paginate(5);*/

            $borradores = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','c.id_org_receptor','c.id_dep_receptor','b.fecha_emision','d.asunto','e.descripcion','c.id_dep_receptor')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('b.id_estatus_emision','=','8')
            ->orderby('id_correspondencia')
            ->paginate(5);         

        
        
        if(!is_null($borradores)){
            return $borradores;
         }else{
            return false;
         }
     } else { //// sino es aprobador consulta las que están asignadas o pendientes por aprobar, estatus 3 en la tabla tblrecepcion

         $borradores = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','c.id_org_receptor','c.id_dep_receptor','b.fecha_emision','d.asunto','e.descripcion','c.id_dep_receptor')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('b.id_estatus_emision','=','8')
            ->orderby('id_correspondencia')
            ->paginate(5);         

        
        
        if(!is_null($borradores)){
            return $borradores;
         }else{
            return false;
         }
     }

    }

     public static function bandejaArchivadas(){

         $id_usuario=Session::get('id');
       
        $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }


                  If (Correspondencia::esAprobador()){  ///// si el usuario es aprobador consulta las corresp enviadas, estatus 6 en la tabla tblrecepcion
         

         $archivadas = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','d.asunto','c.descripcion','b.id_dep_receptor','b.fecha_recepcion')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->join('tbldetallecorrespondencia as d','a.id_correspondencia','d.id_correspondencia')
            //->where('id_org_emisor','=',$usuarioOrg)
            //->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_emision','=','2')
            ->orderby('id_correspondencia')
            ->paginate(5);
        
        
        if(!is_null($archivadas)){
            return $archivadas;
         }else{
            return false;
         }
     } else { //// sino es aprobador consulta las que están asignadas o pendientes por aprobar, estatus 3 en la tabla tblrecepcion

         $archivadas = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','d.asunto','c.descripcion','b.id_dep_receptor','b.fecha_recepcion')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->join('tbldetallecorrespondencia as d','a.id_correspondencia','d.id_correspondencia')
            //->where('id_org_emisor','=',$usuarioOrg)
            //->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_emision','=','2')
            ->orderby('id_correspondencia')
            ->paginate(5);
        
        
        if(!is_null($archivadas)){
            return $archivadas;
         }else{
            return false;
         }
     }

    }



    public static function aprobarCorrespondencia($id){
         
          
           $aprobarCorrespondencia1=Emision::where("id_correspondencia","=",$id)
                                          ->update(['id_estatus_emision' => 6]);

           $aprobarCorrespondencia2=Recepcion::where("id_correspondencia","=",$id)
                                          ->update(['id_estatus_recepcion' => 1]);

         if(!is_null($aprobarCorrespondencia1) &&  !is_null($aprobarCorrespondencia2)){
            return true;
         }else{
            return false;
         }              
   }

   
    public static function archivarCorrespondencia($id){
         
          
           $archivarCorrespondencia1=Emision::where("id_correspondencia","=",$id)
                                          ->update(['id_estatus_emision' => 2]);

           $archivarCorrespondencia2=Recepcion::where("id_correspondencia","=",$id)
                                          ->update(['id_estatus_recepcion' => 2]);

         if(!is_null($archivarCorrespondencia1) &&  !is_null($archivarCorrespondencia2)){
            return true;
         }else{
            return false;
         }              
   }


    public static function asignarCorrespondencia($id,$data){

       
      try {
            DB::beginTransaction();
            
            $id_usuario=Session::get('id');
       
            $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }

      
            $searchRecibidas = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','c.id_org_receptor','c.id','c.id_dep_receptor','c.fecha_recepcion','d.asunto','e.descripcion','b.id_dep_emisor')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('a.id','=',$id)
            ->where('id_estatus_recepcion','=','1')
            ->get();

            foreach ($searchRecibidas as $recibidas){

                $id_correspondencia = $recibidas->id;


            } 

            If (Correspondencia::esAprobador()){ 

       $asignar = new AsignaCorrespondencia;
       $asignar->id_correspondencia = $id;
       $asignar->id_usuario_asigna = $id_usuario;
       $asignar->id_usuario_asignado = $data['id_usuario_asignado'];
       $asignar->id_instruccion =$data['id_instruccion'];
       $asignar->comentario=$data['comentario'];
       $asignar->save();

       $asignar=Emision::findOrFail($id);
       $asignar->id_estatus_emision='4';
       $asignar->update();

       $asignar=Recepcion::findOrFail($id);
       $asignar->id_estatus_recepcion='4';
       $asignar->update();

     }else{

     }
             
            DB::commit();
        }catch (\Exception $e) { //esto atrapa cualquier error y devuelve false al controller
            DB::rollback();
            echo $e->getMessage(); die(); //para probar si hay error
            return false;
        }
        return true;

    }


    public static function rechazarCorrespondencia($id,$data){


     try {
            DB::beginTransaction();
            
           $id_usuario=Session::get('id');
       
            $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }

      
            $searchPorAprobar = DB::table('tblcorrespondencia as a')
             ->select('a.id','a.id_correspondencia','b.fecha_emision','c.id_dep_receptor','d.asunto','d.contenido','e.descripcion')  
             ->join('tblemision as b','a.id','b.id_correspondencia')
             ->join('tblrecepcion as c','a.id','c.id_correspondencia')
             ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
             ->join('tbldependencia as e','c.id_dep_receptor','e.id')
             ->where('id_org_emisor','=',$usuarioOrg)
             ->where('id_dep_emisor','=',$usuarioDep)
             ->where('a.id','=',$id)
             ->where('id_estatus_emision','=','3')
             ->get();

            foreach ($searchPorAprobar as $poraprobar){

                $id_correspondencia = $poraprobar->id_correspondencia;
                $id_recepcion_correspondencia = $poraprobar->id;
            } 

               If (Correspondencia::esAprobador()){ 

       $rechazar = new RechazaCorrespondencia;
       $rechazar->id_correspondencia = $id_recepcion_correspondencia;
       $rechazar->id_usuario_rechaza = $id_usuario;
       $rechazar->id_usuario_recibe = $id_usuario;
       $rechazar->comentario=$data['comentario'];
       $rechazar->save();

       $rechazar=Emision::findOrFail($id);
       $rechazar->id_estatus_emision='5';
       $rechazar->update();

       $rechazar=Recepcion::findOrFail($id);
       $rechazar->id_estatus_recepcion='5';
       $rechazar->update();

     }else{


      }
             
            DB::commit();
        }catch (\Exception $e) { //esto atrapa cualquier error y devuelve false al controller
            DB::rollback();
            echo $e->getMessage(); die(); //para probar si hay error
            return false;
        }
        return true;

    }

    public static function responderCorrespondencia($id,$data){

       try {
            DB::beginTransaction();
            
           
             $id_usuario=Session::get('id');
             $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }

        
         $searchRecibidasId = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','b.id_org_emisor','b.id_dep_emisor','c.id_org_receptor','c.id','c.id_dep_receptor','c.fecha_recepcion','d.asunto','e.descripcion','b.id_dep_emisor','d.id_tipo_confidencialidad','d.id_tipo_correspondencia','d.ubic')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','1')
            ->get();

            foreach ($searchRecibidasId as $recibidas){

                $id_recepcion_correspondencia = $recibidas->id;
                $id_correspondencia = $recibidas->id_correspondencia;
                $id_tipo_confidencialidad = $recibidas->id_tipo_confidencialidad;
                $id_tipo_correspondencia = $recibidas->id_tipo_correspondencia;
                $ubic = $recibidas->ubic;
                $id_org_emisor = $recibidas->id_org_emisor;
                $id_dep_emisor = $recibidas->id_dep_emisor;
                $id_correspondencia_respuesta = $recibidas->id_correspondencia;

            } 

               If (Correspondencia::esAprobador()){ 

            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarId($usuarioOrg,$usuarioDep,$id_tipo_correspondencia);
            $correspondencia->save();
            $id_estatus_correspondencia=10;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $detalle = New DetalleCorrespondencia;
            $detalle->id_correspondencia =$correspondencia->id;
            $detalle->id_tipo_confidencialidad= $id_tipo_confidencialidad;
            $detalle->id_tipo_correspondencia = $id_tipo_correspondencia;
            $detalle->asunto = $data['asunto'];
            $detalle->ubic = $ubic;
            $detalle->contenido = $data['contenido'];
            $detalle->save();


            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id;
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->id_estatus_emision='6';
            $emision->esrespuesta='1';
            $emision->id_correspondencia_respuesta = $id;
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$emision->id_estatus_emision);
            //Correspondencia::guardarAdjunto($correspondencia->id,$adjunto);

            $emision=Emision::findOrFail($id);
            $emision->id_estatus_emision='10';
            $emision->update();


            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id;
            $recepcion->id_org_receptor = $id_org_emisor;
            $recepcion->id_dep_receptor = $id_dep_emisor;
            $recepcion->id_estatus_recepcion ='1';
            $recepcion->save();
            $id_estatus_correspondencia=3;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $recepcion=Recepcion::findOrFail($id);
            $recepcion->id_estatus_recepcion='10';
            $recepcion->update();


     }else{
           
          
            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarId($usuarioOrg,$usuarioDep,$id_tipo_correspondencia);
            $correspondencia->save();
            $id_estatus_correspondencia=10;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $detalle = New DetalleCorrespondencia;
            $detalle->id_correspondencia =$correspondencia->id;
            $detalle->id_tipo_confidencialidad= $id_tipo_confidencialidad;
            $detalle->id_tipo_correspondencia = $id_tipo_correspondencia;
            $detalle->asunto = $data['asunto'];
            $detalle->ubic = $ubic;
            $detalle->contenido = $data['contenido'];
            $detalle->save();


            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id;
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->id_estatus_emision='3';
            $emision->esrespuesta='1';
            $emision->id_correspondencia_respuesta = $id;
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$emision->id_estatus_emision);
            //Correspondencia::guardarAdjunto($correspondencia->id,$adjunto);

            $emision=Emision::findOrFail($id);
            $emision->id_estatus_emision='10';
            $emision->update();

            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id;
            $recepcion->id_org_receptor = $id_org_emisor;
            $recepcion->id_dep_receptor = $id_dep_emisor;
            $recepcion->id_estatus_recepcion ='3';
            $recepcion->save();
            $id_estatus_correspondencia=1;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $recepcion=Recepcion::findOrFail($id);
            $recepcion->id_estatus_recepcion='10';
            $recepcion->update();

      }
             
            DB::commit();
        }catch (\Exception $e) { //esto atrapa cualquier error y devuelve false al controller
            DB::rollback();
            echo $e->getMessage(); die(); //para probar si hay error
            return false;
        }
        return true;
        
    }



    public static function responderasignadasCorrespondencia($id,$data){

       try {
            DB::beginTransaction();
            
           
             $id_usuario=Session::get('id');
             $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }

        
             $searchAsignadasId = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','b.id_org_emisor','b.id_dep_emisor','c.id_org_receptor','c.id_dep_receptor','c.fecha_recepcion','d.asunto','e.descripcion','b.id_dep_emisor','d.id_tipo_correspondencia','d.id_tipo_confidencialidad','d.ubic')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','4')
            ->get();  
        

            foreach ($searchAsignadasId as $asignadas){

                $id_recepcion_correspondencia = $asignadas->id;
                $id_correspondencia = $asignadas->id_correspondencia;
                $id_tipo_confidencialidad = $asignadas->id_tipo_confidencialidad;
                $id_tipo_correspondencia = $asignadas->id_tipo_correspondencia;
                $ubic = $asignadas->ubic;
                $id_org_emisor = $asignadas->id_org_emisor;
                $id_dep_emisor = $asignadas->id_dep_emisor;
                $id_correspondencia_respuesta = $asignadas->id;

            } 

               If (Correspondencia::esAprobador()){ 

            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarId($usuarioOrg,$usuarioDep,$id_tipo_correspondencia);
            $correspondencia->save();
            $id_estatus_correspondencia=10;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $detalle = New DetalleCorrespondencia;
            $detalle->id_correspondencia =$correspondencia->id;
            $detalle->id_tipo_confidencialidad= $id_tipo_confidencialidad;
            $detalle->id_tipo_correspondencia = $id_tipo_correspondencia;
            $detalle->asunto = $data['asunto'];
            $detalle->ubic = $ubic;
            $detalle->contenido = $data['contenido'];
            $detalle->save();


            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id;
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->id_estatus_emision='6';
            $emision->esrespuesta='1';
            $emision->id_correspondencia_respuesta = $id;
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$emision->id_estatus_emision);
            //Correspondencia::guardarAdjunto($correspondencia->id,$adjunto);

            $emision=Emision::findOrFail($id);
            $emision->id_estatus_emision='10';
            $emision->update();
             

            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id;
            $recepcion->id_org_receptor = $id_org_emisor;
            $recepcion->id_dep_receptor = $id_dep_emisor;
            $recepcion->id_estatus_recepcion ='1';
            $recepcion->save();
            $id_estatus_correspondencia=1;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $recepcion=Recepcion::findOrFail($id);
            $recepcion->id_estatus_recepcion='10';
            $recepcion->update();


     }else{
           
         
            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarId($usuarioOrg,$usuarioDep,$id_tipo_correspondencia);
            $correspondencia->save();
            $id_estatus_correspondencia=10;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $detalle = New DetalleCorrespondencia;
            $detalle->id_correspondencia =$correspondencia->id;
            $detalle->id_tipo_confidencialidad= $id_tipo_confidencialidad;
            $detalle->id_tipo_correspondencia = $id_tipo_correspondencia;
            $detalle->asunto = $data['asunto'];
            $detalle->ubic = $ubic;
            $detalle->contenido = $data['contenido'];
            $detalle->save();


            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id;
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->id_estatus_emision='3';
            $emision->esrespuesta='1';
            $emision->id_correspondencia_respuesta = $id_recepcion_correspondencia;
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$emision->id_estatus_emision);
            //Correspondencia::guardarAdjunto($correspondencia->id,$adjunto);

            $emision=Emision::findOrFail($id);
            $emision->id_estatus_emision='10';
            $emision->update();

            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id;
            $recepcion->id_org_receptor = $id_org_emisor;
            $recepcion->id_dep_receptor = $id_dep_emisor;
            $recepcion->id_estatus_recepcion ='3';
            $recepcion->save();
            $id_estatus_correspondencia=1;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $recepcion=Recepcion::findOrFail($id);
            $recepcion->id_estatus_recepcion='10';
            $recepcion->update();

      }
             
            DB::commit();
        }catch (\Exception $e) { //esto atrapa cualquier error y devuelve false al controller
            DB::rollback();
            echo $e->getMessage(); die(); //para probar si hay error
            return false;
        }
        return true;
        
    }


   public static function responderrechazadasCorrespondencia($id,$data){

       try {
            DB::beginTransaction();
            
           
             $id_usuario=Session::get('id');
             $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;
                }

        
             $searchRechazadasId = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','b.id_org_emisor','b.id_dep_emisor','c.id_org_receptor','c.id_dep_receptor','c.fecha_recepcion','d.asunto','e.descripcion','b.id_dep_emisor','d.id_tipo_correspondencia','d.id_tipo_confidencialidad','d.ubic')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','5')
            ->get();  
        

            foreach ($searchRechazadasId as $rechazadas){

                $id_correspondencia = $rechazadas->id_correspondencia;
                $id_tipo_confidencialidad = $rechazadas->id_tipo_confidencialidad;
                $id_tipo_correspondencia = $rechazadas->id_tipo_correspondencia;
                $ubic = $rechazadas->ubic;
                $id_org_emisor = $rechazadas->id_org_emisor;
                $id_dep_emisor = $rechazadas->id_dep_emisor;
                $id_correspondencia_respuesta = $rechazadas->id;

            } 

               If (Correspondencia::esAprobador()){ 

            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarId($usuarioOrg,$usuarioDep,$id_tipo_correspondencia);
            $correspondencia->save();
            $id_estatus_correspondencia=10;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $detalle = New DetalleCorrespondencia;
            $detalle->id_correspondencia =$correspondencia->id;
            $detalle->id_tipo_confidencialidad= $id_tipo_confidencialidad;
            $detalle->id_tipo_correspondencia = $id_tipo_correspondencia;
            $detalle->asunto = $data['asunto'];
            $detalle->ubic = $ubic;
            $detalle->contenido = $data['contenido'];
            $detalle->save();


            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id;
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->id_estatus_emision='6';
            $emision->esrespuesta='1';
            $emision->id_correspondencia_respuesta = $id;
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$emision->id_estatus_emision);
            //Correspondencia::guardarAdjunto($correspondencia->id,$adjunto);

            $emision=Emision::findOrFail($id);
            $emision->id_estatus_emision='10';
            $emision->update();
             

            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id;
            $recepcion->id_org_receptor = $id_org_emisor;
            $recepcion->id_dep_receptor = $id_dep_emisor;
            $recepcion->id_estatus_recepcion ='1';
            $recepcion->save();
            $id_estatus_correspondencia=1;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $recepcion=Recepcion::findOrFail($id);
            $recepcion->id_estatus_recepcion='10';
            $recepcion->update();


     }else{
           
         
            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarId($usuarioOrg,$usuarioDep,$id_tipo_correspondencia);
            $correspondencia->save();
            $id_estatus_correspondencia=10;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

            $detalle = New DetalleCorrespondencia;
            $detalle->id_correspondencia =$correspondencia->id;
            $detalle->id_tipo_confidencialidad= $id_tipo_confidencialidad;
            $detalle->id_tipo_correspondencia = $id_tipo_correspondencia;
            $detalle->asunto = $data['asunto'];
            $detalle->ubic = $ubic;
            $detalle->contenido = $data['contenido'];
            $detalle->save();


            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id;
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->id_estatus_emision='3';
            $emision->esrespuesta='1';
            $emision->id_correspondencia_respuesta = $id;
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$emision->id_estatus_emision);
            //Correspondencia::guardarAdjunto($correspondencia->id,$adjunto);

           

            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id;
            $recepcion->id_org_receptor = $id_org_emisor;
            $recepcion->id_dep_receptor = $id_dep_emisor;
            $recepcion->id_estatus_recepcion ='3';
            $recepcion->save();
            $id_estatus_correspondencia=1;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id,$id_estatus_correspondencia);

           

      }
             
            DB::commit();
        }catch (\Exception $e) { //esto atrapa cualquier error y devuelve false al controller
            DB::rollback();
            echo $e->getMessage(); die(); //para probar si hay error
            return false;
        }
        return true;
        
    }
 

   public static function buscarDestinatario($id){
           
          $id_usuario=Session::get('id'); 

          $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

                foreach ($searchUsuarioID as $usuario) {
                    $usuarioOrg = $usuario->id_org;
                    $usuarioDep = $usuario->id_dep;

           $destinatario = DB::table('users as a')
                     ->where('a.estatus','=','1')
                     ->where('a.id_org','=', $usuarioOrg)
                     ->where('a.id_dep','=', $usuarioDep)
                     //->where('a.id_dep','=','14')
                     ->where('a.perfil','=','20')
                     ->get();
         if(!is_null($destinatario)){
            return $destinatario;
         }else{
            return false;
         }         
                
   }
 }


    public static function generarId($id_org,$id_dep,$id_tipo_correspondencia){
           $prefijo='';

        if ($id_tipo_correspondencia == 10) {
            $prefijo = 'O';
        }else if($id_tipo_correspondencia == 20){
            $prefijo = 'M';
        }else if ($id_tipo_correspondencia == 30) {
            $prefijo = 'C';
        } // el prefijo me traera el tipo de correspondencia (OFICIO-MEMO-CIRCULAR)

       
         $sufijo=date("m-Y");  //variable para alojar mes y año de la correspondencia

         $searchSiglas = DB::table('tbldependencia')
                    ->select('siglas')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_dep)
                    ->where('id_org','=', $id_org)
                    ->get();

        foreach ($searchSiglas as $sigla) {
            $siglas = $sigla->siglas;
        } // arreglo de modelo que me devolvera las siglas de la dependencia
  
        $searchContador= DB::table('tblcorrelativo')
                    ->select('*')
                    ->where('id_dep','=',$id_dep)
                    ->where('id_org','=', $id_org)
                    ->where('id_tipo_correspondencia','=', $id_tipo_correspondencia)
                    ->whereYear('fecha','2017')
                    ->get();

        $contador=1;
          if(count($searchContador) ==0){
            $contador=1;
          
            $correlativo = new Correlativo;
            $correlativo->contador=$contador;
            $correlativo->id_org=$id_org;
            $correlativo->id_dep=$id_dep;
            $correlativo->id_tipo_correspondencia=$id_tipo_correspondencia;
            $correlativo->tipo_correlativo='1';
            $correlativo->save();

          
        } else {
         foreach ($searchContador as $correlativo){
            $contador=$correlativo->contador+1;

         
            $correlativo=Correlativo::findOrFail($correlativo->id);
            $correlativo->contador=$contador;
            $correlativo->updated_at=date('Y-m-d H:i:s');
            $correlativo->update();

        } 
    }

    return $prefijo."-".$siglas."-".str_pad($contador, 4, "0", STR_PAD_LEFT)."-".$sufijo;

    }




    public static function generarIdBorrador($id_org,$id_dep,$id_tipo_correlativo,$id_tipo_correspondencia){
          
         $id_tipo_correlativo=2; 

         $prefijo = 'B';
         $sufijo=date("m-Y");  //variable para alojar mes y año de la correspondencia

         $searchSiglas = DB::table('tbldependencia')
                    ->select('siglas')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_dep)
                    ->where('id_org','=', $id_org)
                    ->get();

        foreach ($searchSiglas as $sigla) {
            $siglas = $sigla->siglas;
        } // arreglo de modelo que me devolvera las siglas de la dependencia
  
        $searchContador= DB::table('tblcorrelativo')
                    ->select('*')
                    ->where('id_dep','=',$id_dep)
                    ->where('id_org','=', $id_org)
                    ->where('tipo_correlativo','=', $id_tipo_correlativo)
                    ->whereYear('fecha','2017')
                    ->get();

        $contador=1;
          if(count($searchContador) ==0){
            $contador=1;
          
            $correlativo = new Correlativo;
            $correlativo->contador=$contador;
            $correlativo->id_org=$id_org;
            $correlativo->id_dep=$id_dep;
            $correlativo->id_tipo_correspondencia=$id_tipo_correspondencia;
            $correlativo->tipo_correlativo='2';
            $correlativo->save();

          
        } else {
         foreach ($searchContador as $correlativo){
            $contador=$correlativo->contador+1;

         
            $correlativo=Correlativo::findOrFail($correlativo->id);
            $correlativo->contador=$contador;
            $correlativo->updated_at=date('Y-m-d H:i:s');
            $correlativo->update();

        } 
    }

    return $prefijo."-".$siglas."-".str_pad($contador, 4, "0", STR_PAD_LEFT)."-".$sufijo;

    }







}