<?php 
//session_start();



if(!isset($page)|| !isset($_SESSION["usuario"])){
	header("location:index.php");
}else{

    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="description" content="Programa bolsa de empleo." />
        <meta name="author" content="Eduardo Morales" />
        <meta name="copyright" content="" />
        <meta name="producto" content="TetuanJobs" />
        <meta name="version" content="V1.0" />
        <link rel="icon"  type="image/png"  href="images/favicon.png"/>

        <title>TetuanJobs | <?php echo $page["nombrePag"]; ?> </title>

        <!-- Bootstrap CSS-->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap-toggle.min.css" rel="stylesheet" />
        <!-- Plugins CSS-->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="plugins/animo/animateanimo.css" rel="stylesheet" />
        <link href="plugins/csspinner/csspinner.min.css" rel="stylesheet" />
        <!--<link href="plugins/Notific/jquery.notific8.min.css" rel="stylesheet" />-->
        <!-- DataTables CSS -->

        <link href="plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" />
        <link href="plugins/datatables/dataTables.responsive.bootstrap.min.css" rel="stylesheet" />


        <!-- Web CSS-->
        <link href="css/app.css" rel="stylesheet" />

        <!-- Aplicación CSS-->
        <link href="css/tetuanjobs.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Modernizr JS Script-->
        <script src="plugins/modernizr/modernizr.js"></script>
        <!-- FastClick for mobiles-->
        <script src="plugins/fastclick/fastclick.js"></script>


    </head>
    <body>

        <div class="wrapper">

            <!--<app:navigation ID="navigation" runat="server" />-->
            <!-- Barra Navegacion -->
            <nav role="navigation" class="navbar navbar-default navbar-top navbar-fixed-top">
                <!--Logo-->
                <div class="navbar-header">
                    <a href="dashboard.php" class="navbar-brand">
                        <div class="brand-logo">
                            <img src="images/logo.png" alt="App Logo" class="img-responsive" />
                        </div>
                        <div class="brand-logo-collapsed">
                            <img src="images/logo-single.png" alt="App Logo" class="img-responsive" />
                        </div>
                    </a>
                </div>
                <!---->
                <div class="nav-wrapper">
                    <!--Iconos izquierdos-->
                    <ul class="nav navbar-nav">
                        <!--Button to show/hide-->
                        <li>
                            <a href="#" data-toggle-state="aside-collapsed" data-persists="true" class="hidden-xs" title="Ocultar Menu">
                                <em class="fa fa-navicon"></em>
                            </a>
                            <a href="#" data-toggle-state="aside-toggled" class="visible-xs" title="Mostrar Menu">
                                <em class="fa fa-navicon"></em>
                            </a>
                        </li>
                        <!---->
                        <!--Refresh-->
                        <!--<li>
                            <a href="#" data-toggle="reset" title="Actualizar">
                                <em class="fa fa-refresh"></em>
                            </a>
                        </li>-->
                        <!---->
                    </ul>
                    <!---->
                    <!--Iconos derechos-->
                    <ul class="nav navbar-nav navbar-right">

                        <!-- Apagar -->
                        <li style="margin-right:10px;">
                            <a href="index.php?logout=true" title="Salir">
                                <em class="fa fa-power-off"> Salir</em>
                            </a>
                        </li> 

                        <!---->
                    </ul>
                    <!---->
                </div>

            </nav>
            <!-- Fin Barra Navegacion -->

            <!-- Menu Lateral -->
            <aside class="aside">
                <nav class="sidebar">
                    <ul class="nav">
                        <li class="nav-heading">Menú</li>
                        <!--Inicio-->
                        <li>                            
                            <a href="dashboard.php" title="Inicio" class="no-submenu">
                                <em class="fa fa-home"></em>
                                <span class="item-text">Inicio</span>
                            </a>
                        </li>
                        <!---->
                        <?php if($_SESSION["usuario"]->tipo == "estudiante"){
                            /*Menú del estudiante*/
                            ?>
                            <!--Perfil-->
                            <li>
                                <a href="perfil_estudiante.php" title="Perfil" class="no-submenu">
                                    <em class="fa fa-user"></em>
                                    <span class="item-text">Perfil</span>
                                </a>               
                            </li>
                            <!---->
                            <!--Busqueda-->
                            <li>
                                <a href="busqueda_ofertas.php" title="Busqueda" class="no-submenu">
                                    <em class="fa fa-search"></em>
                                    <span class="item-text">Búsqueda</span>
                                </a>                            

                            </li>
                            <!----> 

                            <?php }else if($_SESSION["usuario"]->tipo == "administrador"){
                                /* Menú del administrador */
                                ?>
                                <!--Usuarios-->                                
                                <li>                                    
                                    <a href="gestion_estudiantes.php" title="Estudiantes"  class="no-submenu">
                                        <em class="fa fa-user"></em>                                        
                                        <span class="item-text">Estudiantes</span>
                                    </a>             
                                </li>
                                <!---->
                                <!--Empresa-->
                                <li>
                                    <a href="gestion_empresas.php" title="Empresas"  class="no-submenu">
                                        <em class="fa fa-building-o"></em>
                                        <span class="item-text">Empresas</span>                                        
                                    </a>             
                                </li>
                                <!---->
                                <!--Etiquetas idiomas-->
                                <li>
                                    <a href="etiquetas_idiomas.php" title="Etiquetas Idiomas"  class="no-submenu">
                                        <em class="fa fa-tags"></em>
                                        <span class="item-text">Etiquetas e idiomas</span>                                        
                                    </a>             
                                </li>
                                <?php }else if($_SESSION["usuario"]->tipo == "empresa"){ ?> 
                                <!--Perfil-->
                                <li>
                                    <a href="perfil_empresa.php" title="Perfil" class="no-submenu">
                                        <em class="fa fa-user"></em>
                                        <span class="item-text">Perfil</span>
                                    </a>               
                                </li>
                                <!---->
                                <!--Puestos-->
                                <li>
                                    <a href="#" title="Empresas" data-toggle="collapse-next" class="has-submenu">
                                        <em class="fa fa-newspaper-o"></em>
                                        <span class="item-text">Puestos</span>
                                    </a>   
                                    <ul class="nav collapse out">
                                        <li>
                                            <a href="ficha_puestos.php" title="Nuevo" data-toggle="" class="no-submenu subitem">

                                                <span class="item-text">Nuevo puesto</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="filtro_puestos.php" title="Buscar" data-toggle="" class="no-submenu subitem">

                                                <span class="item-text">Buscar puesto</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="interesados.php" title="Interesados" data-toggle="" class="no-submenu subitem">

                                                <span class="item-text">Interesados</span>
                                            </a>
                                        </li>
                                        
                                    </ul> 
                                </li>
                                <!---->
                                <?php } ?> 
                            </ul>
                        </nav>
                    </aside>
                    <!-- Fin Menu Lateral -->


                    <!-- CONTENIDO INICIO -->
                    <section>

                        <!-- START Page content-->
                        <div class="main-content">

                            <?php 
                            echo $page["cuerpo"];

                            ?>
                        </div>
                        <!-- END Page content-->

                        <!--<app:footer ID="footer" runat="server" />-->
                        <footer class="text-center">&copy; 2018 - Copyright - Desarrollado por: Eduardo Morales<br /></footer>

                    </section>
                    <!-- CONTENIDO FIN -->
                </div>

                <!-- Modal -->
                <?php         
                if (isset($page["modal"])) {

                    for ($i=0; $i <count($page["modal"]) ; $i++) { 
                        echo $page["modal"][$i];
                    }

                }
                ?> 
                <!-- Modal mensaje del servidor -->
                <div class="modal fade" id="modalmensaje" >
                    <div class="modal-dialog modal-lg">

                        <!-- Contenido del modal // Un modal es una ventana que se muestra encima del contenido -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- Este boton sirve para cerrar el modal -->
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <!-- Este es el título de la cabecera del modal -->
                                <h4 class="modal-title"><span id="titexp">Aviso</span></h4>
                            </div>

                            <!-- Este es el cuerpo del modal -->
                            <div class="modal-body">
                                <p><?php //echo $_REQUEST["mensaje"]; ?>
                                    <span id="mensajeserv"></span></p>
                                </div>
                                <!-- Este es el pie del modal -->
                                <div class="modal-footer"> 
                                    <input type="button" class="btn btn-info" data-dismiss="modal" value="Salir">
                                    <!-- Para cerrar todos los modales con data-dismiss-->
                                </div>

                            </div>
                        </div>
                    </div>                        

                    <!-- Fin Modal -->

                    <!-- jQuery Scripts-->
                    <script src="js/jquery-2.1.4.min.js"></script>
                    <!-- Bootstrap Scripts-->
                    <script src="js/bootstrap.min.js"></script>
                    <script src="js/bootstrap-toggle.min.js"></script>
                    <!-- Plugins Scripts-->
                    <!--<script src="plugins/jquery.json-2.4.js"></script>-->
                    <script src="plugins/animo/animo.min.js"></script>
                    <script src="plugins/chosen/chosen.jquery.min.js"></script>
                    <script src="plugins/filestyle/bootstrap-filestyle.min.js"></script>
                    <script src="plugins/slider/js/bootstrap-slider.js"></script>
                    <!--<script src="plugins/sparklines/jquery.sparkline.min.js"></script>-->
                    <script src="plugins/slimscroll/jquery.slimscroll.min.js"></script>
                    <!--<script src="plugins/classyloader/js/jquery.classyloader.min.js"></script>-->
                    <script src="plugins/store/storejson2.min.js"></script>
                    <!--<script src="plugins/Notific/jquery.notific8.min.js"></script>-->
                    <!-- Data Table Scripts-->
                    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
                    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

                    <!-- Tabla responsive -->
                    <script src="plugins/datatables/dataTables.responsive.min.js"></script>


                    <script src="js/app.js"></script> 

                    <!-- Aplicación Scripts-->
                    <script src="js/tetuanjobs.js"></script>

                    <?php
                    if(isset($page["js"])){
                        echo $page["js"];
                    }
                    
                    if(isset($_SESSION["mensajeServidor"])){
                        ?> <script type="text/javascript">
                        mensajeModal("<?php echo $_SESSION['mensajeServidor']; ?>");
                        </script>
                       <?php unset($_SESSION["mensajeServidor"]);
                    }

                    if(isset($_SESSION["modificar"])){
                        echo '<script type="text/javascript">
                        modificarModal();
                        </script>';
                        unset($_SESSION["modificar"]);
                    }

                    /*if(isset($_SESSION["etiquetas"])){
                        echo '<script type="text/javascript">
                        agregarEtiquetas('.$_SESSION["etiquetas"].');
                        </script>';
                        unset($_SESSION["etiquetas"]);
                    }*/

                    
                    ?>   

                </body>
                </html>
                <?php   

            }

            ?>


