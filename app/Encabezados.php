<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Encabezados extends Model
{

	protected $table='tblencabezados';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id',
        'descripcion',
        'pie',
        'encabezado',
        'estatus',
        'fecha_creacion',
        'ir_org',
        'id_dep'
        ];
    //


     public static function lista(){
        $imagenes = DB::table('tblencabezados')
                     ->where('estatus','=','1')
                     ->orderby('descripcion')
                     ->paginate(5);

         if(!is_null($imagenes)){
            return $imagenes;
         }else{
            return false;
         }        
    }

    public static function buscar($query){
   
        $imagenes = DB::table('tblencabezados')
                     ->where('estatus','=','1')
                     ->where('descripcion','ilike', "%$query%")
                     ->orderby('descripcion')
                     ->paginate(5);

         if(!is_null($imagenes)){
            return $imagenes;
         }else{
            return false;
         }        
    }
    

    public static function guardar($data){
        $imagenes=new Encabezados;
        $imagenes->descripcion=$data['descripcion'];
        $imagenes->pie=$data['pie'];
        $imagenes->encabezado=$data['encabezado'];
        $imagenes->estatus=1;
        $imagenes->id_org=$data['id_org'];

        $imagenes->save();

         if(!is_null($imagenes)){
            return true;
         }else{
            return false;
         }        
    }

    public static function eliminar($id){
       $imagenes=Encabezados::findOrFail($id);
       $imagenes->estatus='2';

       $imagenes->update();

         if(!is_null($imagenes)){
            return true;
         }else{
            return false;
         }        
    }

}
