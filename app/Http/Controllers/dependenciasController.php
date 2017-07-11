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


class dependenciasController extends Controller
{

	public function index()
    {
      $searchText = Input::get('searchText'); 
      $data= Dependencias::buscar($searchText);
      if ($data){
         return view("dependencias.listDependencias",["data"=>$data,"searchText"=>$searchText]);
      }else{
         return view("layouts.nodata");

      }
    }

    public function create()
    {
      $organismos= Organismos::lista();
      return view("dependencias.create",['organismo'=>$organismos]);
    }

    public function store ()
    {
    $data= array(
                  'id_org'     =>Input::get('id_org'), 
                  'descripcion'=>Input::get('descripcion'),
                  'siglas'=>Input::get('siglas')
                );
         
        $guardar=Dependencias::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }

    public function edit($id)
    {
      $dependencia=Dependencias::findOrFail($id);
      $organismos= Organismos::lista();
      return view("dependencias.update",['data'=>$dependencia,'organismos'=>$organismos]);
    }

    public function update($id)
    {
        $data= array(
                  'id_org'     =>Input::get('id_org'), 
                  'descripcion'=>Input::get('descripcion'),
                  'siglas'=>Input::get('siglas')
              );

       $actualizar=Dependencias::actualizar($id,$data);
        if ($actualizar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Actualizado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al actualizar verifique']);
        }

    }

    public function dependenciaModal($id)
    {
      $dependencia=Dependencias::findOrFail($id);
      return view("dependencias.dependencias-modal",['dependencia'=>$dependencia]);
    }


    public function destroy($id)
    {
       $eliminar=Dependencias::eliminar($id);
        if ($eliminar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Eliminado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al eliminar verifique']);
        }
    }
 	

}
