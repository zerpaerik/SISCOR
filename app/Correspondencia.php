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
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$id_estatus_correspondencia);

            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id_correspondencia;
           // $emision->id_org_emisor     =$data['id_org']; 
            //$emision->id_dep_emisor     =$data['id_dep']; 
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_tipo_correspondencia    =$data['id_tipo_correspondencia']; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->ubic =$data['ubic'];
            $emision->confidencialidad =$data['confidencialidad'];
            $emision->asunto =$data['asunto'];
            $emision->contenido =$data['contenido'];
            $emision->id_estatus_emision='6';
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$emision->id_estatus_emision);
            Correspondencia::guardarAdjunto($correspondencia->id_correspondencia,$adjunto);


            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id_correspondencia;
            $recepcion->id_org_receptor = $id_org;
            $recepcion->id_dep_receptor = $id_dep;
            $recepcion->id_estatus_recepcion ='1';
            $recepcion->save();
            $id_estatus_correspondencia=1;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$id_estatus_correspondencia);


        } else {

        
            $id_estatus_correspondencia=7;
            $adjunto = $data['adjunto'];
            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarId($usuarioOrg,$usuarioDep,$tipo);
            $correspondencia->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$id_estatus_correspondencia);

            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id_correspondencia;
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_tipo_correspondencia    =$data['id_tipo_correspondencia']; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->ubic =$data['ubic'];
            $emision->confidencialidad =$data['confidencialidad'];
            $emision->asunto =$data['asunto'];
            $emision->contenido =$data['contenido'];
            $emision->id_estatus_emision='3';
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$emision->id_estatus_emision);
            Correspondencia::guardarAdjunto($correspondencia->id_correspondencia,$adjunto);

  
            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id_correspondencia;
            $recepcion->id_org_receptor = $id_org;
            $recepcion->id_dep_receptor = $id_dep;
            $recepcion->id_estatus_recepcion ='3';
            $recepcion->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$id_estatus_correspondencia);

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
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$id_estatus_correspondencia);

            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id_correspondencia;
           // $emision->id_org_emisor     =$data['id_org']; 
            //$emision->id_dep_emisor     =$data['id_dep']; 
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_tipo_correspondencia    =$data['id_tipo_correspondencia']; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->ubic =$data['ubic'];
            $emision->confidencialidad =$data['confidencialidad'];
            $emision->asunto =$data['asunto'];
            $emision->contenido =$data['contenido'];
            $emision->id_estatus_emision='8';
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$emision->id_estatus_emision);
            Correspondencia::guardarAdjunto($correspondencia->id_correspondencia,$adjunto);


            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id_correspondencia;
            $recepcion->id_org_receptor = $id_org;
            $recepcion->id_dep_receptor = $id_dep;
            $recepcion->id_estatus_recepcion ='8';
            $recepcion->save();
            $id_estatus_correspondencia=8;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$id_estatus_correspondencia);


        } else {

        
           $id_estatus_correspondencia=8;
            $adjunto = $data['adjunto'];
            $correspondencia = new Correspondencia;
            $correspondencia->id_correspondencia= Correspondencia::generarIdBorrador($usuarioOrg,$usuarioDep,$id_tipo_correlativo,$tipo);
            $correspondencia->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$id_estatus_correspondencia);

            $emision = new Emision;
            $emision->id_correspondencia  =$correspondencia->id_correspondencia;
           // $emision->id_org_emisor     =$data['id_org']; 
            //$emision->id_dep_emisor     =$data['id_dep']; 
            $emision->id_org_emisor     =$usuarioOrg; 
            $emision->id_dep_emisor     =$usuarioDep; 
            $emision->id_tipo_correspondencia    =$data['id_tipo_correspondencia']; 
            $emision->id_usuario_emisor = $id_usuario;
            $emision->id_usuario_aprobador = $id_usuario;
            $emision->ubic =$data['ubic'];
            $emision->confidencialidad =$data['confidencialidad'];
            $emision->asunto =$data['asunto'];
            $emision->contenido =$data['contenido'];
            $emision->id_estatus_emision='8';
            $emision->save();
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$emision->id_estatus_emision);
            Correspondencia::guardarAdjunto($correspondencia->id_correspondencia,$adjunto);


            $recepcion = new Recepcion;
            $recepcion->id_correspondencia  =$correspondencia->id_correspondencia;
            $recepcion->id_org_receptor = $id_org;
            $recepcion->id_dep_receptor = $id_dep;
            $recepcion->id_estatus_recepcion ='8';
            $recepcion->save();
            $id_estatus_correspondencia=8;
            Correspondencia::HistorialCorrespondencia($id_usuario,$correspondencia->id_correspondencia,$id_estatus_correspondencia);
        }
             
            DB::commit();
        }catch (\Exception $e) { //esto atrapa cualquier error y devuelve false al controller
            DB::rollback();
            echo $e->getMessage(); die(); //para probar si hay error
            return false;
        }
        return true;

     }

         
    public static function mostrar(){

      $mostrarCorrespondencia = DB::table('tblemision as a')
            ->select('a.id_correspondencia','a.ubic','a.confidencialidad','a.asunto','a.contenido','e.descripcion','c.descripcion','d.descripcion','f.adjunto')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tblorganismo as c','b.id_org_receptor','c.id')
            ->join('tbldependencia as d','b.id_dep_receptor','d.id')
            ->join('tbltipocorrespondencia as e','a.id_tipo_correspondencia','e.id')
            ->join('tbladjunto as f','a.id_correspondencia','f.id_correspondencia')
            ->orderby('id_correspondencia')
            ->get();
        
        
        if(!is_null($mostrarCorrespondencia)){
            return $mostrarCorrespondencia;
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
         

         $recibidas = DB::table('tblrecepcion as a')
            ->select('a.id_correspondencia','a.id_org_receptor','a.id_dep_receptor','a.fecha_recepcion','b.asunto','c.descripcion','b.id_dep_emisor')
            ->join('tblemision as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_emisor','c.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','1')
            ->orderby('id_correspondencia')
            ->paginate(5);
        
        
        if(!is_null($recibidas)){
            return $recibidas;
         }else{
            return false;
         }
     } else { //// sino es aprobador consulta las que están asignadas o pendientes por aprobar, estatus 3 en la tabla tblrecepcion

         $recibidas = DB::table('tblrecepcion as a')
            ->select('a.id_correspondencia','a.id_org_receptor','a.id_dep_receptor','b.asunto')
            ->join('tblemision as b','a.id_correspondencia','b.id_correspondencia')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','3')
            ->orderby('id_correspondencia')
            ->paginate(5);
        
        
        if(!is_null($recibidas)){
            return $recibidas;
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
         

         $enviadas = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
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

         $enviadas = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','3')
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
         

         $poraprobar = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
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

         $poraprobar = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','3')
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
         

         $borradores = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_emision','=','8')
            ->orderby('id_correspondencia')
            ->paginate(5);
        
        
        if(!is_null($borradores)){
            return $borradores;
         }else{
            return false;
         }
     } else { //// sino es aprobador consulta las que están asignadas o pendientes por aprobar, estatus 3 en la tabla tblrecepcion

         $borradores = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','8')
            ->orderby('id_correspondencia')
            ->paginate(5);
        
        
        if(!is_null($borradores)){
            return $borradores;
         }else{
            return false;
         }
     }

    }



    public static function aprobarCorrespondencia($id_correspondencia){

    try {
            DB::beginTransaction();
            $id_usuario=Session::get('id');
           

            If (Correspondencia::esAprobador()){
            
            //// Actualizo los estatus en las tablad de emisión y recepción.
            $aprobarCorrespondencia=Emision::findOrFail($id_correspondencia);
            $aprobarCorrespondencia->id_usuario_aprobador=$id_usuario;
            $aprobarCorrespondencia->id_estatus_emision='6';
            $aprobarCorrespondencia->update();

            $aprobarCorrespondencia=Recepcion::findOrFail($id_correspondencia);
            $aprobarCorrespondencia->id_estatus_emision='6';
            $aprobarCorrespondencia->update();


        } else {

        
           

        }
             
            DB::commit();
        }catch (\Exception $e) { //esto atrapa cualquier error y devuelve false al controller
            DB::rollback();
            echo $e->getMessage(); die(); //para probar si hay error
            return false;
        }
        return true;

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