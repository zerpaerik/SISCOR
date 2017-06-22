<?php

namespace SISCOR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use DB;
use SISCOR\Usuarios;
use SISCOR\Dependencias;
use SISCOR\Organismos;
use SISCOR\Cargos;

class usuariosController extends Controller
{
    public function index()
    {
      $searchText = Input::get('searchText'); 
      $data= Usuarios::buscar($searchText);
      if ($data){
         return view("usuarios.listUsuarios",["data"=>$data,"searchText"=>$searchText]);
      }else{
         return view("layouts.nodata");

      }
    }

    public function create()
    {
      $organismos= Organismos::lista();
      $dependencias= Dependencias::lista();
      return view("usuarios.create",['organismo'=>$organismos],['dependencia'=>$dependencias]);
    }

    public function store ()
    {
    $data= array(
                  'id_org'     =>Input::get('id_org'), 
                  'descripcion'=>Input::get('descripcion'),
                );
         
        $guardar=Dependencias::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }
}
