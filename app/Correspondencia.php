<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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




    public static function guardar($data){
        try {
            //toda la lógica va dentro del try 
            //Inicia la transacción
            DB::beginTransaction();

            //Implementacion de guardado de Correspondencia con datos del array $data

            $correspondencia=new Correspondencia;//<-- instancia de la misma clase Correspondencia
            $correspondencia->id_correspondencia=$data['id_correspondencia'];
            $correspondencia->fecha=date('Y-m-d H:i:s');
            $correspondencia->save();
            
            if 

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
            $emision->id_estatus_emision=$data['id_estatus_emision']
            $emision->esrespuesta=$data['esrespuesta'];
            $emision->save();










            $emision=new Emision;
            $emision
            $emision
            $emision
            $emision
            $emision
            $emision
            $emision
            $emision
            $emision
            $emision
            $emision
            $emision
            $emision

            

            //se confirman los datos; puede haber multiples implementaciones pero est es el unico commit para todas al final
            DB::commit();

        } catch (\Exception $e) { //esto atrapa cualquier error y devuelve false al controller
            DB::rollback();
            //echo $e->getMessage(); die(); //para probar si hay error 
            return false;
        }

        return true;

    }
    






    
}
