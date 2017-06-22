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
      $cargos= Cargos::lista();
      return view("usuarios.create",['organismo'=>$organismos],['dependencia'=>$dependencias],['cargo'=>$cargos]);
    }

    public function store ()
    {
    $data= array(
                  'cedula'=>Input::get('cedula'),
                  'nombres'=>Input::get('nombres'),
                  'apellidos'=>Input::get('apellidos'),
                  'usuario'=>Input::get('usuario'),
                  'contrasena'=>Input::get('contrasena'),
                  'iniciales'=>Input::get('iniciales'),
                  'id_org'=>Input::get('id_org'),
                  'id_dep'=>Input::get('id_dep'),
                  'id_cargo'=>Input::get('id_org'),
                  'perfil'=>Input::get('perfil'),
                );
         
        $guardar=Usuarios::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }

    public function orgbydep($id)
    {
      $dependencia = Dependencias::orgbydep($id);
      return view("usuarios.orgbydep",['dependencia'=>$dependencia]);
    }
}
