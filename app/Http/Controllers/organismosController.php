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
use SISCOR\Organismos;
use SISCOR\Dependencias;


class organismosController extends Controller
{

	public function index()
    {
      $searchText = Input::get('searchText'); 

      $data= Organismos::buscar($searchText);
      if ($data){
         return view("organismos.listOrganismos",["data"=>$data,'searchText'=>$searchText]);
      }else{
         return view("layouts.nodata");
      }
    }



    public function create()
    {
      //$hola="HOLA MUNDO";
      return view("organismos.create");
      ///return view("organismos.create");

    }

    public function store ()
    {
    $data= array(
                      'descripcion'=>Input::get('descripcion'),
                      'siglas'=>Input::get('siglas')

                    );
         
        $guardar=Organismos::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }

    public function edit($id)
    {
      $organismo=Organismos::findOrFail($id);
      return view("organismos.update",['data'=>$organismo]);
    }

    public function update($id)
    {
        $data= array(
             'descripcion'=>Input::get('descripcion'),
             'siglas'=>Input::get('siglas')
              );

       $actualizar=Organismos::actualizar($id,$data);
        if ($actualizar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Actualizado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al actualizar verifique']);
        }

    }

    public function organismoModal($id)
    {
      $organismo=Organismos::findOrFail($id);
      return view("organismos.organismo-modal",['organismo'=>$organismo]);
    }


    public function destroy($id)
    {
       $eliminar=Organismos::eliminar($id); 
        if ($eliminar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Eliminado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al eliminar verifique']);
        }

    }
}
