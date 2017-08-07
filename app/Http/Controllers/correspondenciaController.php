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


    public function recibidas()
    {
      $searchText = Input::get('searchText');
      $usuarioOrg = Input::get('id_org');
      $usuarioDep = Input::get('id_dep');
      $data= Correspondencia::bandejaRecibidas();
      if ($data){
        return view("correspondencia.bandejas.recibidas.listRecibidas",["data"=>$data,"searchText"=>$searchText]);
      } else{
        return view("layouts.nodata");
      }
    }


    public function enviadas()
    {
      $searchText = Input::get('searchText');
      $usuarioOrg = Input::get('id_org');
      $usuarioDep = Input::get('id_dep');
      $data= Correspondencia::bandejaEnviadas();
      if ($data){
        return view("correspondencia.bandejas.enviadas.listEnviadas",["data"=>$data,"searchText"=>$searchText]);
      } else{
        return view("layouts.nodata");
      }
    }

    public function poraprobar()
    {
      $searchText = Input::get('searchText');
      $usuarioOrg = Input::get('id_org');
      $usuarioDep = Input::get('id_dep');
      $data= Correspondencia::bandejaporAprobar();
      if ($data){
        return view("correspondencia.bandejas.poraprobar.listPorAprobar",["data"=>$data,"searchText"=>$searchText]);
      } else{
        return view("layouts.nodata");
      }
    }

    
     public function borrador()
    {
      $searchText = Input::get('searchText');
      $usuarioOrg = Input::get('id_org');
      $usuarioDep = Input::get('id_dep');
      $data= Correspondencia::bandejaBorrador();
      if ($data){
        return view("correspondencia.bandejas.borrador.listBorrador",["data"=>$data,"searchText"=>$searchText]);
      } else{
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


/*
    public function prueba(){
    echo  Correspondencia::mostrar();
    }
*/

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
    
  

   public function verPorAprobar($id) {
     
     $correspondencia=Correspondencia::where("id_correspondencia",'=',$id);  
     return view("correspondencia.bandejas.poraprobar.mostrar",['data'=>$correspondencia]);

   }


    public function mostrarPorAprobar($id)
    {
      $data= array(
                  'id_correspondencia'=>Input::get('id_correspondencia'),
                  'id_tipo_correspondencia'=>Input::get('id_tipo_correspondencia'),
                  'confidencialidad'=>Input::get('confidencialidad'),
                  'id_org'=>Input::get('id_org'),
                  'id_dep'=>Input::get('id_dep'),
                  'id_dir'=>Input::get('id_dir'),
                  'id_div'=>Input::get('id_div'),
                  'ubic'=>Input::get('ubic'),
                  'confidencialidad'=>Input::get('confidencialidad'),
                  'asunto'=>Input::get('asunto'),
                  'contenido'=>Input::get('contenido')

        );

      $mostrar=Correspondencia::mostrarPorAprobar($id,$data);
      if ($mostrar) {
        return response()->json(['respuesta' => 'success','mensaje' => 'Correspondencia vista']);
      }else{
        return rresponse()->json(['respuesta' => 'success','mensaje' => 'Error mostrando Correspondencia']);
      }
      
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
                  'ubic'=>Input::get('ubic'),
                  'confidencialidad'=>Input::get('confidencialidad'),
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

    
     public function guardarBorrador ()
        {
         $data= array(
                  'id_correspondencia'=>Input::get('id_correspondencia'),
                  'id_tipo_correspondencia'=>Input::get('id_tipo_correspondencia'),
                  'confidencialidad'=>Input::get('confidencialidad'),
                  'id_org'=>Input::get('id_org'),
                  'id_dep'=>Input::get('id_dep'),
                  'id_dir'=>Input::get('id_dir'),
                  'id_div'=>Input::get('id_div'),
                  'ubic'=>Input::get('ubic'),
                  'confidencialidad'=>Input::get('confidencialidad'),
                  'asunto'=>Input::get('asunto'),
                  'contenido'=>Input::get('contenido')
                );

            if(Input::hasFile('adjunto')){
            $file=Input::file('adjunto');
            $file->move(public_path().'/imagenes/correspondencia',$file->getClientOriginalName());
            $file->getClientOriginalName(); 
            $data['adjunto']=$file->getClientOriginalName();          
        }
         
        $guardarBorrador=Correspondencia::guardarBorrador($data);

        if ($guardarBorrador) {
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


   public function recibidasModal($id)
    {
      $recibidas=Correspondencia::findOrFail($id);
      return view("correspondencia.bandejas.recibidas.recibidas-modal",['recibidas'=>$recibidas]);
    }

    public function poraprobarModal($id)
    {
      $poraprobar=Correspondencia::findOrFail($id);
      return view("correspondencia.bandejas.poraprobar.poraprobar-modal",['poraprobar'=>$poraprobar]);
    }


    public function borradoresModal($id)
    {
      $borradores=Correspondencia::findOrFail($id);
      return view("correspondencia.bandejas.borrador.borradores-modal",['borradores'=>$borradores]);
    }

}
