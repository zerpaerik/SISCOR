<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Departamento extends Model
{

	protected $table='tbldepartamento';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'descripcion',
        'id_org',
        'id_dep',
        'id_dir',
        'id_div',
        'siglas',
        'estatus'
        ];

    
    public static function lista(){
        $departamento = DB::table('tbldepartamento as a')
                     ->select('a.id','a.descripcion','a.id_org','b.descripcion as organismo')
                     ->join('tblorganismo as b', 'a.id_org','b.id')
                     ->where('a.estatus','=','1')
                     ->orderby('a.descripcion')
                     ->paginate(5);

         if(!is_null($departamento)){
            return $departamento;
         }else{
            return false;
         }        
    }

    public static function buscar($query){
        $departamento = DB::table('tbldivision as a')
                     ->select('a.id','a.descripcion','a.id_org','b.descripcion as organismo')
                     ->join('tblorganismo as b', 'a.id_org','b.id')
                     ->where('a.estatus','=','1')
                     ->where('a.descripcion','ilike', "%$query%")
                     ->orderby('a.id')
                     ->paginate(5);

         if(!is_null($departamento)){
            return $departamento;
         }else{
            return false;
         }        
    }

    public static function guardar($data){
        $departamento=new Departamento;
        $departamento->descripcion=$data['descripcion'];
        $departamento->id_org=$data['id_org'];
        $departamento->id_dep=$data['id_dep'];
        $departamento->id_dir=$data['id_dir'];
        $departamento->id_div=$data['id_div'];
        $departamento->siglas=$data['siglas'];

        $departamento->save();

         if(!is_null($departamento)){
            return true;
         }else{
            return false;
         }        
    }


    public static function actualizar($id,$data){
       $departamento=Departamento::findOrFail($id);
       $departamento->descripcion=$data['descripcion'];
       $departamento->id_org=$data['id_org'];
       $departamento->id_dep=$data['id_dep'];
       $departamento->id_dir=$data['id_dir'];
       $departamento->id_div=$data['id_div'];
       $departamento->siglas=$data['siglas'];

       $departamento->update();

         if(!is_null($departamento)){
            return true;
         }else{
            return false;
         }        
    }

    public static function eliminar($id){
       $departamento=Departamento::findOrFail($id);
       $departamento->estatus='2';

       $departamento->update();

         if(!is_null($departamento)){
            return true;
         }else{
            return false;
         }        
    }

    //
}
