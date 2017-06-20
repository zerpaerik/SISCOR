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
use SISCOR\Imagenes;
use SISCOR\Organismos;
use SISCOR\Http\Requests\ImagenesFormRequest;

class imagenesController extends Controller
{
    //
   public function index()
    {
      $searchText = Input::get('searchText'); 
      $data= Imagenes::buscar($searchText);
      if ($data){
         return view("imagenes.listImagenes",["data"=>$data,"searchText"=>$searchText]);
      }else{
         return view("layouts.nodata");

      }
    }

    public function create()
    {
      $organismos= Organismos::lista();
      return view("imagenes.create",['organismo'=>$organismos]);
    }

    public function store (ImagenesFormRequest $request)
    {
    $data= array(
                  'descripcion'     =>Input::get('descripcion'), 
                  'pie'=>Input::get('pie'),
                  'encabezado'=>Input::get('encabezado'),
                  'estatus'=>Input::get('estatus'),
                  //'fecha_creacion'=>Input::get('fecha_creacion'),
                  'id_org'=>Input::get('id_org')
                );

        if(Input::hasFile('imagenes')){
            $file=Input::file('imagenes');
            $file->move(public_path().'/imagenes',$file->getClientOriginalName());
            $imagenes->pie=$file->getClientOriginalName();
            $imagenes->encabezado=$file->getClientOriginalName();
            
        }
         
        $guardar=Imagenes::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }




}
