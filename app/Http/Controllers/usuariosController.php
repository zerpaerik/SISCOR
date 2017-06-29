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
use SISCOR\Direccion;
use SISCOR\Division;
use SISCOR\Departamento;
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
      $direccion= Direccion::lista();
      $division= Division::lista();
      $departamento= Departamento::lista();
      $cargos= Cargos::lista();
      return view("usuarios.create",['organismo'=>$organismos],['dependencia'=>$dependencias],['cargo'=>$cargos],['direccion'=>$direccion],['division'=>$division],['departamento'=>$departamento]);
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
                  'id_dir'=>Input::get('id_dir'),
                  'id_div'=>Input::get('id_div'),
                  'cargo'=>Input::get('cargo'),
                  'perfil'=>Input::get('perfil'),
                  'tipo_usuario'=>Input::get('tipo_usuario'),
                  'aprobador'=>Input::get('aprobador')
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

    public function usrbyorg($id)
    {
      $dependencia = Dependencias::orgbydep($id);
      return view("usuarios.orgbydep",['dependencia'=>$dependencia]);
    }


     public function edit($id)
    {
      $dependencia=Dependencias::lista();
      $organismos= Organismos::lista();
      return view("usuarios.update",['data'=>$dependencia,'organismos'=>$organismos]);
    }

    public function update($id)
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
                  'id_dir'=>Input::get('id_dir'),
                  'id_div'=>Input::get('id_div'),
                  'cargo'=>Input::get('cargo'),
                  'perfil'=>Input::get('perfil'),
                  'tipo_usuario'=>Input::get('tipo_usuario'),
                  'aprobador'=>Input::get('aprobador')
              );

       $actualizar=Usuarios::actualizar($id,$data);
        if ($actualizar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Actualizado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al actualizar verifique']);
        }

    }

    public function updatepasswd($id)
    {
        $data= array(
                  'contrasena'=>Input::get('contrasena') 
              );

       $actualizar=Usuarios::actualizar($id,$data);
        if ($actualizar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Actualizado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al actualizar verifique']);
        }

    }


    public function usuarioModal($id)
    {
      $usuario=Usuarios::findOrFail($id);
      return view("usuarios.usuarios-modal",['usuario'=>$usuario]);
    }


    public function destroy($id)
    {
       $eliminar=Usuarios::eliminar($id);
        if ($eliminar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Eliminado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al eliminar verifique']);
        }
    }

    public function login(){
    $data= array(
                  'usuario'=>Input::get('usuario'),
                  'contrasena'=>Input::get('contrasena'),
              );
         
        $login=Usuarios::login($data);

    if ($login) {
            return Redirect::to('user/panelAdmin');
    }else{
      Session::flash('success','Usuario o contraseña incorrectos');
      return Redirect::to('user');

    }
    
    }


    public function logout(){
      Session::flush();
      return Redirect::to('user');

    }




}
