<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Imagenes extends Model
{

	protected $table='tblimagenes';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id',
        'descripcion',
        'pie',
        'encabezado',
        'estatus',
        'fecha_creacion',
        'ir_org'
        ];
    //


     public static function lista(){
        $imagenes = DB::table('tblimagenes')
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
   
        $imagenes = DB::table('tblimagenes')
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
        $imagenes=new Imagenes;
        $imagenes->descripcion=$data['descripcion'];
        $imagenes->pie=$data['pie'];
        $imagenes->encabezado=$data['encabezado'];
        $imagenes->estatus=$data['estatus'];
       // $imagenes->fecha_creacion=$data['fecha_creacion'];
        $imagenes->id_org=$data['id_org'];

        $imagenes->save();

         if(!is_null($imagenes)){
            return true;
         }else{
            return false;
         }        
    }

}
