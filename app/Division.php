<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Division extends Model
{

	protected $table='tbldivision';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'descripcion',
        'id_org',
        'id_dep',
        'id_dir',
        'siglas',
        'estatus'
        ];

    
    public static function lista(){
        $division = DB::table('tbldivision as a')
                     ->select('a.id','a.descripcion','a.id_org','b.descripcion as organismo')
                     ->join('tblorganismo as b', 'a.id_org','b.id')
                     ->where('a.estatus','=','1')
                     ->orderby('a.descripcion')
                     ->paginate(5);

         if(!is_null($division)){
            return $division;
         }else{
            return false;
         }        
    }

    public static function buscar($query){
        $division = DB::table('tbldivision as a')
                     ->select('a.id','a.descripcion','a.id_org','b.descripcion as organismo')
                     ->join('tblorganismo as b', 'a.id_org','b.id')
                     ->where('a.estatus','=','1')
                     ->where('a.descripcion','ilike', "%$query%")
                     ->orderby('a.id')
                     ->paginate(5);

         if(!is_null($division)){
            return $division;
         }else{
            return false;
         }        
    }

    public static function guardar($data){
        $division=new Division;
        $division->descripcion=$data['descripcion'];
        $division->id_org=$data['id_org'];
        $division->id_dep=$data['id_dep'];
        $division->id_dir=$data['id_dir'];
        $division->siglas=$data['siglas'];

        $division->save();

         if(!is_null($division)){
            return true;
         }else{
            return false;
         }        
    }


    public static function actualizar($id,$data){
       $division=Division::findOrFail($id);
       $division->descripcion=$data['descripcion'];
       $division->id_org=$data['id_org'];
       $division->id_dep=$data['id_dep'];
       $division->id_dir=$data['id_dir'];
       $division->siglas=$data['siglas'];

       $division->update();

         if(!is_null($division)){
            return true;
         }else{
            return false;
         }        
    }

    public static function eliminar($id){
       $division=Division::findOrFail($id);
       $division->estatus='2';

       $division->update();

         if(!is_null($division)){
            return true;
         }else{
            return false;
         }        
    }

    //
}
