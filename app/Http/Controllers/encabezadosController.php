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
use SISCOR\Organismos;
use SISCOR\Dependencias;
use SISCOR\Http\Requests\ImagenesFormRequest;

class encabezadosController extends Controller
{
    //
   public function index()
    {
      $searchText = Input::get('searchText'); 
      $data= Encabezados::buscar($searchText);
      if ($data){
         return view("encabezados.listImagenes",["data"=>$data,"searchText"=>$searchText]);
      }else{
         return view("layouts.nodata");

      }
    }

    public function create()
    {
      $organismos= Organismos::lista();
      $dependencias= Dependencias::lista();
      return view("encabezados.create",['organismo'=>$organismos],['dependencia'=>$dependencias]);
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
        
        if(Input::hasFile('encabezado')){
            $file=Input::file('encabezado');
            $file->move(public_path().'/imagenes/pies_encabezados',$file->getClientOriginalName());
            $data['encabezado']=$file->getClientOriginalName();
            
        }
        $guardar=Encabezados::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }

 public function encabezadoModal($id)
    {
      $encabezado=Encabezados::findOrFail($id);
      return view("encabezados.encabezado-modal",['encabezado'=>$encabezado]);
    }


    public function destroy($id)
    {
       $eliminar=Encabezados::eliminar($id);
        if ($eliminar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Eliminado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al eliminar verifique']);
        }
    }


}
