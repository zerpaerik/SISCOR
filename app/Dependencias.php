<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Dependencias extends Model
{
    protected $table='tbldependencia';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id',
        'descripcion',
        'id_org',
        'estatus',
        'id_org'
        ];

    
    public static function lista(){
        $dependencia = DB::table('tbldependencia as a')
                     ->select('a.id','a.descripcion','a.id_org','b.descripcion as organismo')
                     ->join('tblorganismo as b', 'a.id_org','b.id')
                     ->where('a.estatus','=','1')
                     ->orderby('a.descripcion')
                     ->paginate(5);

         if(!is_null($dependencia)){
            return $dependencia;
         }else{
            return false;
         }        
    }

    public static function buscar($query){
        $dependencia = DB::table('tbldependencia as a')
                     ->select('a.id','a.descripcion','a.id_org','b.descripcion as organismo')
                     ->join('tblorganismo as b', 'a.id_org','b.id')
                     ->where('a.estatus','=','1')
                     ->where('a.descripcion','ilike', "%$query%")
                     ->orderby('a.descripcion')
                     ->paginate(5);

         if(!is_null($dependencia)){
            return $dependencia;
         }else{
            return false;
         }        
    }

    public static function guardar($data){
        $dependencia=new Dependencias;
        $dependencia->descripcion=$data['descripcion'];
        $dependencia->id_org=$data['id_org'];

        $dependencia->save();

         if(!is_null($dependencia)){
            return true;
         }else{
            return false;
         }        
    }


    public static function actualizar($id,$data){
       $dependencia=Dependencias::findOrFail($id);
       $dependencia->descripcion=$data['descripcion'];

       $dependencia->update();

         if(!is_null($dependencia)){
            return true;
         }else{
            return false;
         }        
    }

    public static function eliminar($id){
       $dependencia=Dependencias::findOrFail($id);
       $dependencia->estatus='2';

       $dependencia->update();

         if(!is_null($dependencia)){
            return true;
         }else{
            return false;
         }        
    }

    public static function orgbydep($id){
                $dependencia = DB::table('tbldependencia as a')
                     ->where('a.estatus','=','1')
                     ->where('a.id_org','=', $id)
                     ->orderby('a.descripcion')
                     ->get();
         if(!is_null($dependencia)){
            return $dependencia;
         }else{
            return false;
         }

    }

}
