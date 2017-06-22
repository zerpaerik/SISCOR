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
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown4"><i class="fa fa-envelope fa-fw"></i> <i class="material-icons right">arrow_drop_down</i></a></li>               
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown3"><i class="fa fa-tasks fa-fw"></i> <i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown2"><i class="fa fa-bell fa-fw"></i> <i class="material-icons right">arrow_drop_down</i></a></li>
                  <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown1"><i class="fa fa-user fa-fw"></i> <b>Admin SISCOR</b> <i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
        </nav>
        <!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
<li><a href="#"><i class="fa fa-user fa-fw"></i>Mis Datos</a>
</li>
<li><a href="#"><i class="fa fa-gear fa-fw"></i>Modificar</a>
</li> 
<li><a href="#"><i class="fa fa-sign-out fa-fw"></i>Cerrar Sesión</a>
</li>
</ul>
<ul id="dropdown2" class="dropdown-content w250">
  <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
</ul>
<ul id="dropdown3" class="dropdown-content dropdown-tasks w250">
<li>
        <a href="#">
            <div>
                <p>
                    <strong>Task 1</strong>
                    <span class="pull-right text-muted">60% Complete</span>
                </p>
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                        <span class="sr-only">60% Complete (success)</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="#">
            <div>
                <p>
                    <strong>Task 2</strong>
                    <span class="pull-right text-muted">28% Complete</span>
                </p>
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100" style="width: 28%">
                        <span class="sr-only">28% Complete</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="#">
            <div>
                <p>
                    <strong>Task 3</strong>
                    <span class="pull-right text-muted">60% Complete</span>
                </p>
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                        <span class="sr-only">60% Complete (warning)</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="#">
            <div>
                <p>
                    <strong>Task 4</strong>
                    <span class="pull-right text-muted">85% Complete</span>
                </p>
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%">
                        <span class="sr-only">85% Complete (danger)</span>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class="divider"></li>
    <li>
</ul>   
<ul id="dropdown4" class="dropdown-content dropdown-tasks w250">
  <li>
                            <a href="#">
                                <div>
                                    <strong>John Doe</strong>
                                    <span class="pull-right text-muted">
                                        <em>Today</em>
                                    </span>
                                </div>
                                <div>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem Ipsum has been the industry's standard dummy text ever since an kwilnw...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem Ipsum has been the industry's standard dummy text ever since the...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
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
                        <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Organismos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="redireccion" href="{{asset('/organismos/create')}}">Crear</a>
                            </li>
                            <li>
                                <a class="redireccion" href="{{asset('/organismos/listOrganismos')}}">Listar</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-dark"><i class="fa fa-home "></i>Dependencias<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="redireccion" href="{{asset('/dependencias/create')}}">Crear</a>
                            </li>
                            <li>
                                <a class="redireccion" href="{{asset('/dependencias/listDependencias')}}">Listar</a>
                            </li>
                        </ul>
                    </li>
                     <li>
                        <a href="#" class="waves-effect waves-dark"><i class="fa fa-tags "></i>Cargos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="redireccion" href="{{asset('/cargos/create')}}">Crear</a>
                            </li>
                            <li>
                                <a class="redireccion" href="{{asset('/cargos/listCargos')}}">Listar</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-dark"><i class="fa fa-bars "></i>Pie/Encabezados <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="redireccion" href="{{asset('/imagenes/create')}}">Crear</a>
                            </li>
                            <li>
                                <a class="redireccion" href="{{asset('/imagenes/listImagenes')}}">Listar</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-dark"><i class="fa fa-user "></i>Usuarios <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="redireccion" href="{{asset('/usuarios/create')}}">Crear</a>
                            </li>
                            <li>
                                <a class="redireccion" href="{{asset('/usuarios/listIUsuarios')}}">Listar</a>
                            </li>
                        </ul>
                    </li>
                    

                    </li>
                    <li>
                        <a href="form.html" class="waves-effect waves-dark"><i class="fa fa-edit"></i> Forms </a>
                    </li>


                    <li>
                        <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="empty.html" class="waves-effect waves-dark"><i class="fa fa-fw fa-file"></i> Empty Page</a>
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