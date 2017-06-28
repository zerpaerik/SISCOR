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
use SISCOR\Departamento;

class departamentoController extends Controller
{

    public function index()
    {
      $searchText = Input::get('searchText'); 
      $data= Departamento::buscar($searchText);
      if ($data){
         return view("departamentos.listDepartamentos",["data"=>$data,"searchText"=>$searchText]);
      }else{
         return view("layouts.nodata");

      }
    }

    public function create()
    {
      $organismos= Organismos::lista();
      $dependencia= Dependencias::lista();
      $direccion= Direccion::lista();
      $division= Division::lista();
      return view("departamentos.create",['organismo'=>$organismos],['dependencia'=>$dependencia],['direccion'=>$direccion],['division'=>$division]);
    }

    public function store ()
    {
    $data= array(
    	          'descripcion'=>Input::get('descripcion'),
                  'id_org'     =>Input::get('id_org'), 
                  'id_dep'     =>Input::get('id_dep'),
                  'id_dir'     =>Input::get('id_dir'),
                  'id_div'     =>Input::get('id_div'),
                  'siglas'     =>Input::get('siglas'),
                  'estatus'    =>Input::get('estatus')
                );
         
        $guardar=Departamento::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }


    public function edit($id)
    { 
      $departamento=Departamento::findOrFail($id);
      $division=Division::lista();
      $direccion=Direccion::lista();
      $dependencia=Dependencias::lista();
      $organismos= Organismos::lista();
      return view("departamentos.update",['data'=>$departamento,'organismos'=>$organismos,'dependencia'=>$dependencia ,'direccion'=>$direccion,'division'=>$division]);
    }

    public function update($id)
    {
        $data= array(
                  'descripcion'=>Input::get('descripcion'),
                  'id_org'     =>Input::get('id_org'), 
                  'id_dep'     =>Input::get('id_dep'),
                  'id_dir'     =>Input::get('id_dir'),
                  'id_div'     =>Input::get('id_div'),
                  'siglas'     =>Input::get('siglas'),
                  'estatus'    =>Input::get('estatus')
              );

       $actualizar=Departamento::actualizar($id,$data);
        if ($actualizar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Actualizado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al actualizar verifique']);
        }

    }


     public function departamentoModal($id)
    {
      $departamento=Departamento::findOrFail($id);
      return view("departamentos.departamentos-modal",['departamento'=>$departamento]);
    }

    public function dirbydiv($id)
    {
      $division = Division::depbydir($id);
      return view("departamentos.dirbydiv",['division'=>$division]);
    }


    public function destroy($id)
    {
       $eliminar=Departamento::eliminar($id);
        if ($eliminar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Eliminado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al eliminar verifique']);
        }
    }

}
