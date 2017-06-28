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
use SISCOR\Division;

class divisionController extends Controller
{

    public function index()
    {
      $searchText = Input::get('searchText'); 
      $data= Division::buscar($searchText);
      if ($data){
         return view("divisiones.listDivisiones",["data"=>$data,"searchText"=>$searchText]);
      }else{
         return view("layouts.nodata");

      }
    }

    public function create()
    {
      $organismos= Organismos::lista();
      $dependencia= Dependencias::lista();
      $direccion= Direccion::lista();
      return view("divisiones.create",['organismo'=>$organismos],['dependencia'=>$dependencia],['direccion'=>$direccion]);
    }

    public function store ()
    {
    $data= array(
    	          'descripcion'=>Input::get('descripcion'),
                  'id_org'     =>Input::get('id_org'), 
                  'id_dep'     =>Input::get('id_dep'),
                  'id_dir'     =>Input::get('id_dir'),
                  'siglas'     =>Input::get('siglas'),
                  'estatus'    =>Input::get('estatus')
                );
         
        $guardar=Division::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }


    public function edit($id)
    { 
      $division=Division::findOrFail($id);
      $direccion=Direccion::lista();
      $dependencia=Dependencias::lista();
      $organismos= Organismos::lista();
      return view("direcciones.update",['data'=>$division,'organismos'=>$organismos,'dependencia'=>$dependencia ,'direccion'=>$direccion]);
    }

    public function update($id)
    {
        $data= array(
                  'descripcion'=>Input::get('descripcion'),
                  'id_org'     =>Input::get('id_org'), 
                  'id_dep'     =>Input::get('id_dep'),
                  'id_dir'     =>Input::get('id_dir'),
                  'siglas'     =>Input::get('siglas'),
                  'estatus'    =>Input::get('estatus')
              );

       $actualizar=Division::actualizar($id,$data);
        if ($actualizar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Actualizado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al actualizar verifique']);
        }

    }


     public function divisionModal($id)
    {
      $division=Division::findOrFail($id);
      return view("divisiones.divisiones-modal",['division'=>$division]);
    }

    public function depbydir($id)
    {
      $direccion = Direccion::depbydir($id);
      return view("divisiones.depbydir",['direccion'=>$direccion]);
    }


    public function destroy($id)
    {
       $eliminar=Division::eliminar($id);
        if ($eliminar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Eliminado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al eliminar verifique']);
        }
    }

}
