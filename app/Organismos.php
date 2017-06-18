<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Organismos extends Model
{
    protected $table='tblorganismo';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id',
        'descripcion'
        ];


    public static function lista(){
        $organismo = DB::table('tblorganismo')
                     ->where('estatus','=','1')
                     ->orderby('descripcion')
                     ->paginate(5);

         if(!is_null($organismo)){
            return $organismo;
         }else{
            return false;
         }        
    }


    public static function buscar($query){
   
        $organismo = DB::table('tblorganismo')
                     ->where('estatus','=','1')
                     ->where('descripcion','ilike', "%$query%")
                     ->orderby('descripcion')
                     ->paginate(5);

         if(!is_null($organismo)){
            return $organismo;
         }else{
            return false;
         }        
    }

    public static function guardar($data){
        $organismo=new Organismos;
        $organismo->descripcion=$data['descripcion'];

        $organismo->save();

         if(!is_null($organismo)){
            return true;
         }else{
            return false;
         }        
    }


    public static function actualizar($id,$data){
       $organismo=Organismos::findOrFail($id);
       $organismo->descripcion=$data['descripcion'];

       $organismo->update();

         if(!is_null($organismo)){
            return true;
         }else{
            return false;
         }        
    }

    public static function eliminar($id){
       $organismo=Organismos::findOrFail($id);
       $organismo->estatus='2';

       $organismo->update();

         if(!is_null($organismo)){
            return true;
         }else{
            return false;
         }        
    }

}
