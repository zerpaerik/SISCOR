<?php

namespace SISCOR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use DB;
use Illuminate\Support\Facades\Auth;
use SISCOR\Encabezados;
use SISCOR\Pie;
use SISCOR\Organismos;
use SISCOR\Dependencias;
use SISCOR\Http\Requests\ImagenesFormRequest;

class pieController extends Controller
{
    //
   public function index()
    {
      $searchText = Input::get('searchText'); 
      $data= Pie::buscar($searchText);
      if ($data){
         return view("pie.listPie",["data"=>$data,"searchText"=>$searchText]);
      }else{
         return view("layouts.nodata");

      }
    }

    public function create()
    {
      $organismos= Organismos::lista();
      $dependencias= Dependencias::lista();
      return view("pie.create",['organismo'=>$organismos],['dependencia'=>$dependencias]);
    }

    public function store ()
    {
    $data= array(

                  'descripcion' =>Input::get('descripcion'), 
                  'estatus'     =>Input::get('estatus'),
                  'id_org'      =>Input::get('id_org'),
                  'id_dep'      =>Input::get('id_dep')

                );

        if(Input::hasFile('pie')){
            $file=Input::file('pie');
            $file->move(public_path().'/imagenes/pies_encabezados',$file->getClientOriginalName());
            $file->getClientOriginalName(); 
            $data['pie']=$file->getClientOriginalName();          
        }
        
        $guardar=Pie::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }

 public function pieModal($id)
    {
      $pie=Pie::findOrFail($id);
      return view("pie.pie-modal",['pie'=>$pie]);
    }


    public function destroy($id)
    {
       $eliminar=Pie::eliminar($id);
        if ($eliminar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Eliminado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al eliminar verifique']);
        }
    }


}
