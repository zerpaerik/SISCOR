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
use SISCOR\Cargos;

class cargosController extends Controller
{

    
public function index()
    {
      $searchText = Input::get('searchText'); 

      $data= Cargos::buscar($searchText);
      if ($data){
         return view("cargos.listCargos",["data"=>$data,'searchText'=>$searchText]);
      }else{
         return view("layouts.nodata");
      }
    }

    public function create()
    {
     // return view("cargos.create", ['erik' => $hola]);
     return view("cargos.create");

    }

    public function store ()
    {
    $data= array(
                      'descripcion'=>Input::get('descripcion'),

                    );
         
        $guardar=Cargos::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }

    public function edit($id)
    {
      $cargo=Cargos::findOrFail($id);
      return view("cargos.update",['data'=>$cargo]);
    }

    public function update($id)
    {
        $data= array(
             'descripcion'=>Input::get('descripcion')
              );

       $actualizar=Cargos::actualizar($id,$data);
        if ($actualizar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Actualizado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al actualizar verifique']);
        }
        }
    

    public function cargoModal($id)
    {
      $cargo=Cargos::findOrFail($id);
      return view("cargos.cargos-modal",['cargo'=>$cargo]);
    }


    public function destroy($id)
    {
       $eliminar=Cargos::eliminar($id); 
        if ($eliminar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Eliminado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al eliminar verifique']);
        }

    }





    //
}
