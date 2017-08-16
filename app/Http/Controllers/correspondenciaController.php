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

    public function asignadas()
    {
      $searchText = Input::get('searchText');
      $usuarioOrg = Input::get('id_org');
      $usuarioDep = Input::get('id_dep');
      $data = correspondencia::bandejaAsignadas();
      if ($data){
        return view("correspondencia.bandejas.asignadas.listAsignadas",["data"=>$data,"searchText"=>$searchText]);
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

      public function archivadas()
    {
      $searchText = Input::get('searchText');
      $usuarioOrg = Input::get('id_org');
      $usuarioDep = Input::get('id_dep');
      $data= Correspondencia::bandejaArchivadas();
      if ($data){
        return view("correspondencia.bandejas.archivadas.listArchivadas",["data"=>$data,"searchText"=>$searchText]);
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



    public function prueba(){
    echo  Correspondencia::mostrarCorrespondencia(25);
    }


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
    
  public function verEnviadas($id) {
     
     $correspondencia=Correspondencia::mostrarCorrespondencia($id);
     return view("correspondencia.bandejas.enviadas.mostrar",['data'=>$correspondencia]);

   }

  public function verRecibidas($id) {
     
     $correspondencia=Correspondencia::mostrarCorrespondencia($id);
     return view("correspondencia.bandejas.recibidas.mostrar",['data'=>$correspondencia]);

   }

    public function verAsignadas($id) {
     
     $correspondencia=Correspondencia::mostrarCorrespondencia($id);
     return view("correspondencia.bandejas.asignadas.mostrar",['data'=>$correspondencia]);

   }

   public function verPorAprobar($id) {
     
     $correspondencia=Correspondencia::mostrarCorrespondencia($id);
     return view("correspondencia.bandejas.poraprobar.mostrar",['data'=>$correspondencia]);

   }

    public function verBorrador($id) {
     
     $correspondencia=Correspondencia::mostrarCorrespondencia($id);
     return view("correspondencia.bandejas.borrador.mostrar",['data'=>$correspondencia]);

   }

   public function verArchivadas($id) {
     
     $correspondencia=Correspondencia::mostrarCorrespondencia($id);
     return view("correspondencia.bandejas.archivadas.mostrar",['data'=>$correspondencia]);

   }


   public function aprobarCorrespondencia($id){
        
       
       $aprobarCorrespondencia=Correspondencia::aprobarCorrespondencia($id);
        if ($aprobarCorrespondencia) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Aprobado Exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al actualizar verifique']);
        }

   }

   public function archivarCorrespondencia($id){
        
       
       $archivarCorrespondencia=Correspondencia::archivarCorrespondencia($id);
        if ($archivarCorrespondencia) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Archivado Exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al archivar verifique']);
        }

   }


   public function asignarCorrespondencia($id){
        
       $data = array ('id_instruccion'     =>Input::get('id_instruccion'), 
                      'id_usuario_asignado'=>Input::get('id_usuario_asignado'),
                      'comentario'=>Input::get('comentario')
                  );

      $asignarCorrespondencia=Correspondencia::asignarCorrespondencia($id,$data);
        if ($asignarCorrespondencia) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Asignado Exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al archivar verifique']);
        }

       

   }

    public function rechazarCorrespondencia($id){
        
       $data = array ('comentario'=>Input::get('comentario')
                  );

      $rechazarCorrespondencia=Correspondencia::rechazarCorrespondencia($id,$data);
        if ($rechazarCorrespondencia) {
          return response()->json(['respuesta' => 'success','mensaje' => 'Rechazado Exitosamente']);
        }else{
          return response()->json(['respuesta' => 'fail','mensaje' => 'Error al archivar verifique']);
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

    public function buscarDestinatario($id)
    {
      $destinatario = Correspondencia::buscarDestinatario($id);
      return view("correspondencia.bandejas.recibidas.asignar",['destinatario'=>$destinatario]);
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

    public function archivadasModal($id)
    {
      $archivadas=Correspondencia::findOrFail($id);
      return view("correspondencia.bandejas.archivadas.archivadas-modal",['archivadas'=>$archivadas]);
    }

}
