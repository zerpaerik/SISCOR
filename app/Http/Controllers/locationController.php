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
use SISCOR\Location;
use Illuminate\Support\Facades\Hash;

class locationController extends Controller
{

	public function index()
    {
        
      $data= Location::lista();
      //$data= false;
      if ($data){
         return view("location.listLocation",["data"=>$data]);
      }else{
         return view("layouts.nodata");

      }
    }

    public function create()
    {
      return view("location.create");

    }

    public function store ()
    {
    $data= array(
                      'nombre'=>Input::get('nombre'),
                      'lat'=>Input::get('lat'),
                      'lng'=>Input::get('lng'),

                    );
         
        $guardar=Location::guardar($data);

        if ($guardar) {
            return Redirect::to('user/panelAdmin');
        }else{
            return Redirect::to('user');

        }
    }

    public function edit($id)
    {
      $location = Location::findOrFail($id);
      return view("location.update",['data'=>$location]);
    }

    public function update($id)
    {
        $data= array(
                      'nombre'=>Input::get('nombre'),
                      'lat'=>Input::get('lat'),
                      'lng'=>Input::get('lng'),
              );

       $actualizar=Location::actualizar($id,$data);
       if ($actualizar) {
          return Redirect::to('location/listLocation'); 
       }else{
          return Redirect::to('location');
       }

    }

    public function destroy($id)
    {
       $eliminar=Location::eliminar($id);
       if ($eliminar) {
          return Redirect::to('location/listLocation'); 
       }else{
          return Redirect::to('location');
       }

    }
 	


    public function logout(){
 	    Session::flush();
 			return Redirect::to('regularuser');

    }

}
