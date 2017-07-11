<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Cargos extends Model
{

	protected $table='tblcargos';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id',
        'descripcion'
        ];


     public static function lista(){
        $cargo = DB::table('tblcargos')
                     ->where('estatus','=','1')
                     ->orderby('descripcion')
                     ->paginate(5);

         if(!is_null($cargo)){
            return $cargo;
         }else{
            return false;
         }        
    }


    public static function buscar($query){
   
        $cargo = DB::table('tblcargos')
                     ->where('estatus','=','1')
                     ->where('descripcion','ilike', "%$query%")
                     ->orderby('descripcion')
                     ->paginate(5);

         if(!is_null($cargo)){
            return $cargo;
         }else{
            return false;
         }        
    }

    public static function guardar($data){
        $cargo=new Cargos;
        $cargo->descripcion=$data['descripcion'];

        $cargo->save();

         if(!is_null($cargo)){
            return true;
         }else{
            return false;
         }        
    }


    public static function actualizar($id,$data){
       $cargo=Cargos::findOrFail($id);
       $cargo->descripcion=$data['descripcion'];

       $cargo->update();

         if(!is_null($cargo)){
            return true;
         }else{
            return false;
         }        
    }

    public static function eliminar($id){
       $cargo=Cargos::findOrFail($id);
       $cargo->estatus='2';

       $cargo->update();

         if(!is_null($cargo)){
            return true;
         }else{
            return false;
         }        
    }

    //
}
