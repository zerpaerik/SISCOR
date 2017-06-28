<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Direccion extends Model
{

	protected $table='tbldireccion';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'descripcion',
        'id_org',
        'id_dep',
        'siglas',
        'estatus'
        ];

    
    public static function lista(){
        $direccion = DB::table('tbldireccion as a')
                     ->select('a.id','a.descripcion','a.id_org','b.descripcion as organismo')
                     ->join('tblorganismo as b', 'a.id_org','b.id')
                     ->where('a.estatus','=','1')
                     ->orderby('a.descripcion')
                     ->paginate(5);

         if(!is_null($direccion)){
            return $direccion;
         }else{
            return false;
         }        
    }

    public static function buscar($query){
        $direccion = DB::table('tbldireccion as a')
                     ->select('a.id','a.descripcion','a.id_org','b.descripcion as organismo')
                     ->join('tblorganismo as b', 'a.id_org','b.id')
                     ->where('a.estatus','=','1')
                     ->where('a.descripcion','ilike', "%$query%")
                     ->orderby('a.id')
                     ->paginate(5);

         if(!is_null($direccion)){
            return $direccion;
         }else{
            return false;
         }        
    }

    public static function guardar($data){
        $direccion=new Direccion;
        $direccion->descripcion=$data['descripcion'];
        $direccion->id_org=$data['id_org'];
        $direccion->id_dep=$data['id_dep'];
        $direccion->siglas=$data['siglas'];

        $direccion->save();

         if(!is_null($direccion)){
            return true;
         }else{
            return false;
         }        
    }


    public static function actualizar($id,$data){
       $direccion=Direccion::findOrFail($id);
       $direccion->descripcion=$data['descripcion'];
       $direccion->id_org=$data['id_org'];
       $direccion->id_dep=$data['id_dep'];
       $direccion->siglas=$data['siglas'];

       $direccion->update();

         if(!is_null($direccion)){
            return true;
         }else{
            return false;
         }        
    }

    public static function depbydir($id){
                $direccion= DB::table('tbldireccion as a')
                     ->where('a.estatus','=','1')
                     ->where('a.id_dep','=', $id)
                     ->orderby('a.descripcion')
                     ->get();
         if(!is_null($direccion)){
            return $direccion;
         }else{
            return false;
         }

    }

    public static function eliminar($id){
       $direccion=Direccion::findOrFail($id);
       $direccion->estatus='2';

       $direccion->update();

         if(!is_null($direccion)){
            return true;
         }else{
            return false;
         }        
    }

    //
}
