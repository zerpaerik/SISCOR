﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Correspondencia</title>
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/materialize/css/materialize.min.css')}}" media="screen,projection" />
    <!-- Bootstrap Styles-->
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="{{asset('assets/js/morris/morris-0.4.3.min.css')}}" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="{{asset('assets/css/custom-styles.css')}}" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="{{asset('assets/js/Lightweight-Chart/cssCharts.css')}}"> 
    <!--toasts notification-->
    <link href="{{asset('assets/css/toastr.css')}}" rel="stylesheet" />


</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand waves-effect waves-dark" href="index.html"><i class="large material-icons">email</i> <strong>SISCOR</strong></a>
                
        <div id="sideNav" href=""><i class="material-icons dp48">toc</i></div>
            </div>

            <ul class="nav navbar-top-links navbar-right"> 
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown4">
                <i class="fa fa-tags fa-fw"></i> 
                <i class="material-icons right">arrow_drop_down</i>
                </a>
                </li>               
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown3"><i class="fa fa-sitemap fa-fw"></i> <i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown2"><i class="fa fa-user fa-fw"></i> <i class="material-icons right">arrow_drop_down</i></a></li>
                  <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown1"><i class="fa fa-user fa-fw"></i> <span class="hidden-xs">{{Session::get('nombre')}}</span> <i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
        </nav>
        <!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">

<li><a href="{{asset('/usuarios/updatepasswd')}}"><i class="fa fa-gear fa-fw"></i>Modificar Contraseña</a>
</li> 
<li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i>Cerrar Sesión</a>
</li>
</ul>
<ul id="dropdown2" class="dropdown-content w250">
 
        
                        <li>
                            <a class="redireccion" href="{{asset('/usuarios/create')}}">
                                <div>
                                    <i class="fa fa-user"></i> Crear Usuarios
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="redireccion" href="{{asset('/usuarios/listUsuarios')}}">
                                <div>
                                    <i class="fa fa-user"></i> Listar Usuarios
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        
</ul>
<ul id="dropdown3" class="dropdown-content dropdown-tasks w250">

                        <li class="divider"></li>
                        <li>
                            <a class="redireccion" href="{{asset('/organismos/create')}}">
                                <div>
                                    <i class="fa fa-sitemap"></i> Crear Organismos
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>


                        <li class="divider"></li>
                        <li>
                            <a class="redireccion" href="{{asset('/organismos/listOrganismos')}}">
                                <div>
                                    <i class="fa fa-sitemap"></i> Listar Organismos
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="redireccion" href="{{asset('/dependencias/create')}}">
                                <div>
                                    <i class="fa fa-arrows-alt" aria-hidden="true"></i> Crear Dependencias
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="redireccion" href="{{asset('/dependencias/listDependencias')}}">
                                <div>
                                    <i class="fa fa-arrows-alt" aria-hidden="true"></i> Listar Dependencias
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="redireccion" href="{{asset('/direcciones/create')}}">
                                <div>
                                    <i class="fa fa-th-list" aria-hidden="true"></i> Crear Direcciones
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="redireccion" href="{{asset('/direcciones/listDirecciones')}}">
                                <div>
                                    <i class="fa fa-th-list" aria-hidden="true"></i> Listar Direcciones
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="redireccion" href="{{asset('/divisiones/create')}}">
                                <div>
                                    <i class="fa fa-table" aria-hidden="true"></i> Crear Divisiones
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="redireccion" href="{{asset('/divisiones/listDivisiones')}}">
                                <div>
                                    <i class="fa fa-table" aria-hidden="true"></i> Listar Divisiones
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>



    <li class="divider"></li>
    <li>
</ul>   
<ul id="dropdown4" class="dropdown-content dropdown-tasks w250">
  <li>                       

<li>
                            <a class="redireccion" href="{{asset('/encabezados/create')}}">
                                <div>
                                    <i class="fa fa-table" aria-hidden="true"></i> Crear Encabezados
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="redireccion" href="{{asset('/encabezados/listImagenes')}}">
                                <div>
                                    <i class="fa fa-table" aria-hidden="true"></i> Listar Encabezados
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="redireccion" href="{{asset('/pie/create')}}">
                                <div>
                                    <i class="fa fa-table" aria-hidden="true"></i> Crear Pie
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="redireccion" href="{{asset('/pie/listPie')}}">
                                <div>
                                    <i class="fa fa-table" aria-hidden="true"></i> Listar Pie
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                 
                        </ul>
                    </li>


</ul>  
       <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu waves-effect waves-dark" href="index.html"><i class="fa fa-dashboard"></i>Menú Principal</a>
                    </li>
                   
                  
                    <li>
                        <a href="#" class="waves-effect waves-dark"><i class="fa fa-envelope"></i> Correspondencia<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="redireccion" href="{{asset('/correspondencia/create')}}">Redactar Nueva</a>
                            </li>
                            
                            
                        </ul>
                    </li>


                    <li>
                        <a href="#" class="waves-effect waves-dark"><i class="fa fa-envelope"></i> Bandejas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="redireccion" href="{{asset('/correspondencia/bandejas/recibidas/ListRecibidas')}}">Recibidas</a>
                                <a class="redireccion" href="{{asset('/correspondencia/bandejas/recibidas/ListRecibidas')}}">Por Aprobar</a>
                                <a class="redireccion" href="{{asset('/correspondencia/bandejas/recibidas/ListRecibidas')}}">Enviadas</a>
                                <a class="redireccion" href="{{asset('/correspondencia/bandejas/recibidas/ListRecibidas')}}">Asignadas</a>
                                <a class="redireccion" href="{{asset('/correspondencia/bandejas/recibidas/ListRecibidas')}}">Borrador</a>
                                <a class="redireccion" href="{{asset('/correspondencia/bandejas/recibidas/ListRecibidas')}}">Archivadas</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
      
        <div id="page-wrapper">
       <!--   <div class="header"> 
                        <h1 class="page-header">
                            
                        </h1>
                        <ol class="breadcrumb">
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li class="active"></li>
                    </ol> 
                                    
            </div>-->
            <div id="page-inner">

                <div id="contenidoppal">@yield('contenido')</div>

                
                <div class="row">
                <div class="col-md-12">
                
                    </div>      
                </div>  
                <!-- /. ROW  -->
   
                

                <!-- /. ROW  -->
    <div class="fixed-action-btn horizontal click-to-toggle">
    <a class="btn-floating btn-large red">
      <i class="material-icons">menu</i>
    </a>
    <ul>
      <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
      <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
      <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
      <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
    </ul>
  </div>
        
                <footer><p>Desarrollado Por: <a href="http://guarico.gob.ve/pagina_oficial//">Gobernación del Estado Bolivariano de Guárico</a></p>
                
        
                </footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>
    
    <script src="{{asset('assets/js/ajax.min.js')}}"></script>

    <!-- Bootstrap Js -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    
    <script src="{{asset('assets/materialize/js/materialize.min.js')}}"></script>
    
    <!-- Metis Menu Js -->
    <script src="{{asset('assets/js/jquery.metisMenu.js')}}"></script>
    <!-- Morris Chart Js -->
    <script src="{{asset('assets/js/morris/raphael-2.1.0.min.js')}}"></script>
    <script src="{{asset('assets/js/morris/morris.js')}}"></script>
    
    
    <script src="{{asset('assets/js/easypiechart.js')}}"></script>
    <script src="{{asset('assets/js/easypiechart-data.js')}}"></script>
    
     <script src="{{asset('assets/js/Lightweight-Chart/jquery.chart.js')}}"></script>

     <script src="{{asset('vendors/ckeditor/ckeditor.js')}}"></script>
    
    <!-- Custom Js -->
    <script src="{{asset('assets/js/custom-scripts.js')}}"></script> 
    <!-- toaster notifications Js -->
    <script src="{{asset('assets/js/toastr.js')}}"></script> 


 
    <script type="text/javascript">
        //para cargar en contenido central sin reiniciar la pag
        $(".redireccion").on("click",function(e)
        {
              e.preventDefault();
              $.ajax({
                 type: "get",
                 url: $(this).attr("href"),
                 success: function(a) {
                    $('#contenidoppal').html(a);
                 }
              });
        })

    </script>

</body>

</html>