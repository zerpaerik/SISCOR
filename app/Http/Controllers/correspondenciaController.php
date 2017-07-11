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
use SISCOR\Correspondencia;


class correspondenciaController extends Controller
{

   public function index()
    {
      $searchText = Input::get('searchText'); 
      $data= Correspondencia::buscar($searchText);
      if ($data){
         return view("correspondencia.bandejas.recibidas.listRecibidas",["data"=>$data,"searchText"=>$searchText]);
      }else{
         return view("layouts.nodata");

      }
    }



	public function create()
    {
      $organismos= Organismos::lista();
      $dependencias= Dependencias::lista();
      $cargos= Cargos::lista();
      return view("correspondencia.create",['organismo'=>$organismos],['dependencia'=>$dependencias],['cargo'=>$cargos]);
    }


   

    public function prueba(){
    echo  Correspondencia::guardarAdjunto('M-DGI-0001-07-2017','adjunto prueba');
    
}




    public function store ()
    {
    $data= array(
                  'id_correspondencia'=>Input::get('id_correspondencia'),
                  'id_tipo_correspondencia'=>Input::get('id_tipo_correspondencia'),
                  'confidencialidad'=>Input::get('confidencialidad'),
                  'id_org'=>Input::get('id_org'),
                  'id_dep'=>Input::get('id_dep'),
                  'id_dir'=>Input::get('id_dir'),
                  'id_div'=>Input::get('id_div'),
                  'enatencion'=>Input::get('enatencion'),
                  'asunto'=>Input::get('asunto'),
                  'contenido'=>Input::get('contenido')
                );



            if(Input::hasFile('adjunto')){
            $file=Input::file('adjunto');
            $file->move(public_path().'/imagenes/correspondencia',$file->getClientOriginalName());
            $file->getClientOriginalName(); 
            $data['adjunto']=$file->getClientOriginalName();          
        }
         
        $guardar=Correspondencia::guardar($data);

        if ($guardar) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Guardado exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al guardar verifique']);
        }
    }

     public function usrbyorg($id)
    {
      $destinatario = Usuarios::usrbyorg($id);
      return view("correspondencia.usrbyorg",['destinatario'=>$destinatario]);
    }

    public function prueba(){
     echo  Correspondencia::generarId(1,1,1);
    }
}
