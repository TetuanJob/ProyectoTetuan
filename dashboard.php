﻿<?php
$page["nombrePag"] = "Dashboard";
include_once("funciones/generalF.php");
session_start();
if(!isset($_SESSION["usuario"])){
    header("location:login.php");
}

ob_start();
?>
<h1 style="text-align: center; color: #060349"><b>Bienvenido a Tetuán Jobs</b>
   
</h1>
<div class="panel sinborde col-md-12">

    <h2>Usuario <?php echo $_SESSION["usuario"]->nombre; ?></h2>

</div>
<div class="panel sinborde col-md-12 " data-toggle="play-animation" data-play="bounceIn" data-offset="0" >
    <?php 
    /* Estudiante*/
    if($_SESSION["usuario"]->tipo == "estudiante"){                            

        ?>
        <!-- Perfil -->
        <div class="panel sinborde col-md-6" id="panel-anim-zoomOut">
            <a href="perfil_estudiante.php" data-toggle="play-animation" data-play="zoomOut" data-target="#panel-anim-zoomOut"> 
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel widget">
                            <div class="panel-body bg-inverse text-center">
                                <em class="fa fa-user" style="font-size: 75px"></em>
                                <h3>Perfil</h3>
                            </div>
                        </div>
                    </div>
                </div>                                                                        
            </a>
        </div>
        <!-- Fin de Perfil -->
        <!-- Búsqueda -->
        <div class="panel sinborde col-md-6" id="panel-anim-zoomOut1">
            <a href="busqueda_estudiante.php" data-toggle="play-animation" data-play="zoomOut" data-target="#panel-anim-zoomOut1">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel widget">
                            <div class="panel-body bg-inverse text-center">
                                <em class="fa fa-archive" style="font-size: 75px"></em>
                                <h3>Búsqueda</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Fin de Búsqueda -->  

        <?php 
        /* Administrador*/
    }else if($_SESSION["usuario"]->tipo == "administrador"){                            

        ?>  
        <!-- Usuarios -->
        <div class="panel sinborde col-md-4" id="panel-anim-zoomOut">
            <a href="filtro_usuarios.php" data-toggle="play-animation" data-play="zoomOut" data-target="#panel-anim-zoomOut"> 
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel widget">
                            <div class="panel-body bg-inverse text-center">
                                <em class="fa fa-user" style="font-size: 75px"></em>
                                <h3>Usuarios</h3>
                            </div>
                        </div>
                    </div>
                </div>                                                                        
            </a>
        </div>
        <!-- Fin de Usuarios-->
        <!-- Empresas -->
        <div class="panel sinborde col-md-4" id="panel-anim-zoomOut1">
            <a href="filtro_empresas.php" data-toggle="play-animation" data-play="zoomOut" data-target="#panel-anim-zoomOut1">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel widget">
                            <div class="panel-body bg-inverse text-center">
                                <em class="fa fa-building-o" style="font-size: 75px"></em>
                                <h3>Empresas</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Fin de Empresas -->  
        <!-- Puestos -->
        <div class="panel sinborde col-md-4" id="panel-anim-zoomOut1">
            <a href="ficha_puestos.php" data-toggle="play-animation" data-play="zoomOut" data-target="#panel-anim-zoomOut1">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel widget">
                            <div class="panel-body bg-inverse text-center">
                                <em class="fa fa-newspaper-o" style="font-size: 75px"></em>
                                <h3>Puestos</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Fin de puestos --> 
        <?php } ?>
    </div>
    <?php
    $page["cuerpo"] = ob_get_clean();
    /** Incluimos el fichero cuerpo **/
    include_once("cuerpo.php");
    ?>
