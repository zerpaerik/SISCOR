<?php

namespace SISCOR\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use DB;
use SISCOR\Dependencias;
use SISCOR\Organismos;
use SISCOR\Direccion;

class direccionController extends Controller
{

    public function index()
    {
      $searchText = Input::get('searchText'); 
      $data= Direccion::buscar($searchText);
      if ($data){
         return view("direcciones.listDirecciones",["data"=>$data,"searchText"=>$searchText]);
      }else{
         return view("layouts.nodata");

      }
    }

    public function create()
    {
      $organismos= Organismos::lista();
      $dependencia= Dependencias::lista();
      return view("direcciones.create",['organismo'=>$organismos],['dependencia'=>$dependencia]);
    }

    public function store ()
    {
    $data= array(
    	          'descripcion'=>Input::get('descripcion'),
                  'id_org'     =>Input::get('id_org'), 
                  'id_dep'     =>Input::get('id_dep'),
                  'siglas'=>Input::get('siglas'),
                  'estatus'=>Input::get('estatus')
                );
         
        $guardar=Direccion::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }


    public function edit($id)
    {
      $direccion=Direccion::findOrFail($id);
      $dependencia=Dependencias::lista();
      $organismos= Organismos::lista();
      return view("direcciones.update",['data'=>$direccion,'organismos'=>$organismos,'dependencia'=>$dependencia ]);
    }

    public function update($id)
    {
        $data= array(
                  'descripcion'=>Input::get('descripcion'),
                  'id_org'     =>Input::get('id_org'), 
                  'id_dep'     =>Input::get('id_dep'),
                  'siglas'=>Input::get('siglas')
              );

       $actualizar=Direccion::actualizar($id,$data);
        if ($actualizar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Actualizado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al actualizar verifique']);
        }

    }


     public function direccionModal($id)
    {
      $direccion=Direccion::findOrFail($id);
      return view("direcciones.direcciones-modal",['direccion'=>$direccion]);
    }


    public function destroy($id)
    {
       $eliminar=Direccion::eliminar($id);
        if ($eliminar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Eliminado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al eliminar verifique']);
        }
    }












	//
}
