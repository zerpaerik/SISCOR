<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use SISCOR\UsuariosAprobadores;
use SISCOR\Usuarios;

class Correspondencia extends Model
{
	protected $table='tblcorrespondencia';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id_correspondencia',
        'fecha'
        
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

  /*  public static function generarId($id_org,$id_dep,$id_tipo_correspondencia){
        
        if ($data['id_tipo_correspondencia'] == '10'){
        	$generarID= ('O-siglas_org-siglas_dep-');
        	return $generarID;
        } else if ($data['id_tipo_correspondencia'] == '20'){
        	$generarID= ('M-siglas_org-siglas_dep-');
        	return $generarID;

        } else if ($data['id_tipo_correspondencia'] == '30'){
        	$generarID= ('C-siglas_org-siglas_dep-')
    }
*/



  /*  public static function guardar($data){
         $aprobador10 = DB::table('tblusuarios')
                     ->where('estatus','=','1')
                     ->where('aprobador','=','1')
                     ->where('perfil','=','10')
                     ->get();
                    

         if(!is_null($aprobador)){
            return $aprobador;
         }else{
            return false;
         }        
    }

        try {
            //toda la lógica va dentro del try 
            //Inicia la transacción
            DB::beginTransaction();

            //Implementacion de guardado de Correspondencia con datos del array $data

            $correspondencia=new Correspondencia;//<-- instancia de la misma clase Correspondencia
            $correspondencia->id_correspondencia=$data['id_correspondencia'];
            $correspondencia->fecha=date('Y-m-d H:i:s');
            $correspondencia->save();
            //if ($data['aprobador'] == "1" &&  )
            $historial= new HistorialCorrespondencia;
            $historial->id_correspondencia =$correspondencia->id_correspondencia;
            $historial->id_usuario=$data['id_usuario'];
            $historial->id_estatus_correspondencia=$data['id_estatus_correspondencia'];
            $historial->fecha=date('Y-m-d H:i:s');
            $historial->emiorec=$data['emiorec'];
            $historial->save();
             
            $emision= new Emision;
            $emision->id_correspondencia =$correspondencia->id_correspondencia;
            $emision->id_org_emisor=$data['id_org_emisor'];
            $emision->id_dep_emisor=$data['id_dep_emisor'];
            $emision->id_tipo_correspondencia=$data['id_tipo_correspondencia'];
            $emision->id_usuario_emisor=$data['id_usuario_emisor'];
            $emision->id_usuario_aprobador=$data['id_usuario_aprobador'];
            $emision->fecha_emision=date('Y-m-d H:i:s');
            $emision->id_estatus_emision=$data['id_estatus_emision'];
            $emision->esrespuesta=$data['esrespuesta'];
            $emision->save();

            //-->////////////////-----/___/----////////////////<--//

            $recepcion= new Recepcion;
            $recepcion->id_correspondencia =$correspondencia->id_correspondencia;
            $recepcion->id_org_receptor=$data['id_org_receptor'];
            $recepcion->id_dep_receptor=$data['id_dep_receptor'];
            $recepcion->id_estatus_recepcion=$data['id_estatus_recepcion'];
            $recepcion->save();

            $correlativo= new Correlativo;
            $correlativo->id_correspondencia =$correspondencia->id_correspondencia;
            $correlativo->contador=$data['contador'];
            $correlativo->fecha=date('Y-m-d H:i:s');
            $correlativo->id_tipo_correspondencia=$data['id_tipo_correspondencia'];
            $correlativo->save();
          

            

            //se confirman los datos; puede haber multiples implementaciones pero est es el unico commit para todas al final
            DB::commit();

        } catch (\Exception $e) { //esto atrapa cualquier error y devuelve false al controller
            DB::rollback();
            //echo $e->getMessage(); die(); //para probar si hay error 
            return false;
        }

        return true;

    }*/
    
    public static function generarId($id_org,$id_dep,$tipo_com){
        if ($tipo_com == 1) {
            $prefijo = 'O';
        }else if($tipo_com == 2){
            $prefijo = 'M';
        }else if ($tipo_com == 3) {
            $prefijo = 'C';
        }
        $sufijo = date("m-Y");

        $searchSiglas = DB::table('tbldependencia')
                    ->select('siglas')
                    ->where('estatus','=','1')
                    ->where('id','=', $id_dep)
                    ->where('id_org','=', $id_org)
                    ->get();

        foreach ($searchSiglas as $sigla) {
            $siglas = $sigla->siglas;
        }
        return $siglas;
    }
    
}
