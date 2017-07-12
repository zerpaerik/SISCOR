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
	public function create()
    {
      $organismos= Organismos::lista();
      $dependencias= Dependencias::lista();
      $cargos= Cargos::lista();
      return view("correspondencia.create",['organismo'=>$organismos],['dependencia'=>$dependencias],['cargo'=>$cargos]);
    }


   

    public function prueba(){
     echo  Correspondencia::generarId(28,14,14,1);
    
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
                  'cargo'=>Input::get('cargo'),
                  'perfil'=>Input::get('perfil'),
                  'tipo_usuario'=>Input::get('tipo_usuario'),
                  'estatus'=>Input::get('estatus')
                );
         
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

    //
}
