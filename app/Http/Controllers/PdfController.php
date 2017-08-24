<?php

namespace SISCOR\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use SISCOR\Usuarios;
use SISCOR\Dependencias;
use SISCOR\Organismos;
use SISCOR\Cargos;
use SISCOR\Correspondencia;

class PdfController extends Controller
{
     

    public function index(){

        return view("reportes.listado");
    }


    public function crearPDF($datos,$vistaurl,$tipo){

       
       $data = $datos;
       $date = date("Y-m-d");
       $view = \View::make($vistaurl, compact('data','date'))->render();
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);

       if($tipo==1){return $pdf->stream('enviada');}
       if($tipo==2){return $pdf->download('enviada.pdf');}

       /*
       $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('pdf.invoice', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');

       */

    }

    public function listado_enviadas($tipo){

      $vistaurl = "reportes.listado_enviadas";
      $enviadas = Correspondencia::reporteListadoEnviadas();

      return $this->crearPDF($enviadas,$vistaurl,$tipo);

    }

     public function listado_recibidas($tipo){

      $vistaurl = "reportes.listado_recibidas";
      $recibidas = Correspondencia::bandejaRecibidas();

      return $this->crearPDF($recibidas,$vistaurl,$tipo);

    }





}
