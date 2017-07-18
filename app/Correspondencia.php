<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use SISCOR\UsuariosAprobadores;
use SISCOR\Usuarios;
use SISCOR\Correlativo;

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

    
    public static function generarId($id_org,$id_dep,$id,$id_tipo_correspondencia){

        if ($id_tipo_correspondencia == 1) {
            $prefijo = 'O';
        }else if($id_tipo_correspondencia == 2){
            $prefijo = 'M';
        }else if ($id_tipo_correspondencia == 3) { 
            $prefijo = 'C';
        } // el prefijo me traera el tipo de correspondencia (OFICIO-MEMO-CIRCULAR)

         
         $sufijo=date("m-Y");  //variable para alojar mes y año de la correspondencia

         $searchSiglas = DB::table('tbldependencia')
                    ->select('siglas')
                    ->where('estatus','=','1')
                    ->where('id','=', $id)
                    ->where('id_org','=', $id_org)
                    ->get();

        foreach ($searchSiglas as $sigla) {
            $siglas = $sigla->siglas;
        } // arreglo de modelo que me devolvera las siglas de la dependencia

        $searchContador= DB::table('tblcorrelativo')
                    ->select('*')
                    ->where('id_dep','=',$id_dep)
                    ->where('id_org','=', $id_org)
                    ->whereYear('created_at','2017')
                    ->get();

        $contador=1;
          if(count($searchContador) ==0){
            $contador=1;
            
            $correlativo = new Correlativo;
            $correlativo->contador=$contador;
            $correlativo->id_org=$id_org;
            $correlativo->id_dep=$id_dep;
            $correlativo->id_tipo_correspondencia=$id_tipo_correspondencia;
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
    //return $correlativo->contador;
      // return $correlativo->contador;
    return $prefijo."-".$siglas."-".str_pad($contador, 4, "0", STR_PAD_LEFT)."-".$sufijo;

   //return str_pad($contador, 4, "0", STR_PAD_LEFT);

   //return var_dump($searchContador);



    public static function guardar($data){


      return true;

        
    }
    
}
}