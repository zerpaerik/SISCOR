<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Pie extends Model
{

	protected $table='tblpie';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id',
        'descripcion',
        'pie',
        'estatus',
        'fecha_creacion',
        'ir_org',
        'id_dep'
        ];
    //


     public static function lista(){
        $pie = DB::table('tblpie')
                     ->where('estatus','=','1')
                     ->orderby('descripcion')
                     ->paginate(5);

         if(!is_null($pie)){
            return $pie;
         }else{
            return false;
         }        
    }

    public static function buscar($query){
   
        $pie = DB::table('tblpie')
                     ->where('estatus','=','1')
                     ->where('descripcion','ilike', "%$query%")
                     ->orderby('descripcion')
                     ->paginate(5);

         if(!is_null($pie)){
            return $pie;
         }else{
            return false;
         }        
    }
    

    public static function guardar($data){
        $pie=new Pie;
        $pie->descripcion=$data['descripcion'];
        $pie->pie=$data['pie'];
        $pie->estatus=1;
        $pie->id_org=$data['id_org'];
        $pie->id_dep=$data['id_dep'];

        $pie->save();

         if(!is_null($pie)){
            return true;
         }else{
            return false;
         }        
    }

    public static function eliminar($id){
       $pie=Pie::findOrFail($id);
       $pie->estatus='2';

       $pie->update();

         if(!is_null($pie)){
            return true;
         }else{
            return false;
         }        
    }

}
