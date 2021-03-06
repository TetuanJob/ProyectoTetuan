﻿<?php

/**$page tendrá el resto del contenido que se mostrará en el cuerpo**/
/**Este es el nombre de la página, aparecerá en el title del cuerpo**/
$page["nombrePag"] = "Perfil";
include_once('funciones/estudianteF.php');
session_start();


if(!isset($_SESSION["usuario"])){
    header("location:index.php");
}else if($_SESSION["usuario"]->tipo != "estudiante"){
    header("location:dashboard.php");
}




$estudiantecl = new EstudianteBBDD;
/*$estudiantecl->eliminarUsuario();*/

/*echo session_status();*/

if(isset($_POST["elusuario"])&&isset($_POST["token"])&&isset($_SESSION["tokens"])){
    $token = $_POST["token"];
    if($estudiantecl->comprobarToken("elusuario", $token)){
        $estudiantecl->eliminarUsuario();
    }else{
        $_SESSION["mensajeServidor"] = "El tiempo de espera ha caducado o el formulario no es válido.<br>".
        "Recargue la página y vuelva a intentarlo";
    }

}



/* Tokens para asegurar la integridad de los formularios */

if(isset($_POST["token"])&&isset($_SESSION["tokens"])){

    $token = $_POST["token"];

    if(isset($_POST["nuevaexp"])){
        if($estudiantecl->comprobarToken("nuevaexp", $token)){
            $estudiantecl->nuevaExperiencia();
        }else{
            $_SESSION["mensajeServidor"] = "El tiempo de espera ha caducado o el formulario no es válido.<br>".
            "Recargue la página y vuelva a intentarlo";
        }

    }elseif(isset($_POST["nuevaform"])){
        if($estudiantecl->comprobarToken("nuevaform", $token)){
            $estudiantecl->nuevaFormacion();
        }else{
            $_SESSION["mensajeServidor"] = "El tiempo de espera ha caducado o el formulario no es válido.<br>".
            "Recargue la página y vuelva a intentarlo";
        }

    }elseif(isset($_POST["nuevoidioma"])){
        if($estudiantecl->comprobarToken("nuevoidioma", $token)){
            $estudiantecl->nuevoIdioma();
        }else{
            $_SESSION["mensajeServidor"] = "El tiempo de espera ha caducado o el formulario no es válido.<br>".
            "Recargue la página y vuelva a intentarlo";
        }

    }elseif(isset($_POST["guardarinfo"])){
        if($estudiantecl->comprobarToken("guardarinfo", $token)){
            $estudiantecl->modificarinfo();
        }else{
            $_SESSION["mensajeServidor"] = "El tiempo de espera ha caducado o el formulario no es válido.<br>".
            "Recargue la página y vuelva a intentarlo";
        }

    }elseif(isset($_POST["modcontr"])){
        if($estudiantecl->comprobarToken("modcontr", $token)){
            $estudiantecl->cambiarContr();
        }else{
            $_SESSION["mensajeServidor"] = "El tiempo de espera ha caducado o el formulario no es válido.<br>".
            "Recargue la página y vuelva a intentarlo";
        }

    }elseif(isset($_POST["guardaretiquetas"])){
        if($estudiantecl->comprobarToken("guardaretiquetas", $token)){
            $estudiantecl->agregarEtiquetas();
        }else{
            $_SESSION["mensajeServidor"] = "El tiempo de espera ha caducado o el formulario no es válido.<br>".
            "Recargue la página y vuelva a intentarlo";
        }

    }elseif(isset($_POST["elimexp"])||isset($_POST["modmexp"])){
        if($estudiantecl->comprobarToken("modmexp", $token)){
            $estudiantecl->eliminarExperiencia();
            $estudiantecl->modificarExperiencia();
        }else{
            $_SESSION["mensajeServidor"] = "El tiempo de espera ha caducado o el formulario no es válido.<br>".
            "Recargue la página y vuelva a intentarlo";
        }

    }elseif(isset($_POST["elimedc"])||isset($_POST["modmedc"])){
        if($estudiantecl->comprobarToken("modmedc", $token)){
            $estudiantecl->eliminarEducacion();
            $estudiantecl->modificarFormacion();
        }else{
            $_SESSION["mensajeServidor"] = "El tiempo de espera ha caducado o el formulario no es válido.<br>".
            "Recargue la página y vuelva a intentarlo";
        }

    }elseif(isset($_POST["elimidio"])||isset($_POST["modidio"])){
        if($estudiantecl->comprobarToken("modidio", $token)){
            $estudiantecl->eliminarIdioma();
            $estudiantecl->modificarIdioma();
        }else{
            $_SESSION["mensajeServidor"] = "El tiempo de espera ha caducado o el formulario no es válido.<br>".
            "Recargue la página y vuelva a intentarlo";
        }

    }



}

/* Fin Tokens para asegurar la integridad de los formularios */


/**$estudiantecl->cambiarContr();*/
/**$estudiantecl->modificarinfo();*/
/**$estudiantecl->nuevaExperiencia();*/
/**$estudiantecl->nuevaFormacion();*/
/**$estudiantecl->nuevoIdioma();*/
/**$estudiantecl->eliminarExperiencia();*/
/**$estudiantecl->eliminarEducacion();*/
/**$estudiantecl->eliminarIdioma();*/
/**$estudiantecl->modificarIdioma();*/
/**$estudiantecl->modificarFormacion();*/

/**$estudiantecl->modificarExperiencia();*/
/**$estudiantecl->agregarSkills();*/

//print_r($informacion);
//print_r($_SESSION["usuario"]);


/*print_r($estudiantecl->provincias);*/




/** Abro un buffer para alamacenar el html en el buffer**/
ob_start();

/* Función para modificar através de modales */

$estudiantecl->modalModificarExperiencia();

$estudiantecl->modalModificarIdioma(); 

$estudiantecl->modalModificarFormacion(); 

?>

<!--Modal experiencia-->
<!-- El id es importante en el modal porque através del atributo data-target="iddelmodal" con un botón
    lo vamos a invocar -->
    <form method="post">
        <div class="modal fade" id="modalexp" >
            <div class="modal-dialog modal-lg">

                <!-- Contenido del modal // Un modal es una ventana que se muestra encima del contenido -->
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- Este boton sirve para cerrar el modal -->
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <!-- Este es el título de la cabecera del modal -->
                        <h4 class="modal-title"><span id="titexp">Añadir un nuevo puesto de trabajo</span></h4>
                    </div>

                    <!-- Este es el cuerpo del modal -->
                    <div class="modal-body">
                        <!-- Esta es una fila dentro del cuerpo del modal -->
                        <div class="row">
                        <!-- Esta clase ocupa 6 columnas del grid de 12, lo que seria la mitad
                        pero cómo es md sólo se aplicará a una resolución de hasta 992 px-->
                        <div class="col-md-6">
                            <!-- La clase form-group da estilo al formulario-->
                            <div class="form-group">
                                <label>Título</label>
                                <!-- La clase form-control da estilo al input-->
                                <input type="text" class="form-control" name="tituloEmp" value="" required>
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Empresa</label>
                                <input type="text" class="form-control" name="nombreEmp" value="" >
                            </div>    
                        </div> 

                    </div>                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Período</label><br>
                                <select class="conborde" name="f1mes">
                                    <option value="1">enero</option>
                                    <option value="2">febrero</option>
                                    <option value="3">marzo</option>
                                    <option value="4">abril</option>
                                    <option value="5">mayo</option>
                                    <option value="6">junio</option>
                                    <option value="7">julio</option>
                                    <option value="8">agosto</option>
                                    <option value="9">septiembre</option>
                                    <option value="10">octubre</option>
                                    <option value="11">noviembre</option>
                                    <option value="12">diciembre</option>
                                </select>
                                <input type="text" class="conborde text-center" name="f1anio" placeholder="Año" maxlength="4" size="4" > - 
                                
                                <select class="conborde selact" name="f2mes">                                        
                                    <option value="1">enero</option>
                                    <option value="2">febrero</option>
                                    <option value="3">marzo</option>
                                    <option value="4">abril</option>
                                    <option value="5">mayo</option>
                                    <option value="6">junio</option>
                                    <option value="7">julio</option>
                                    <option value="8">agosto</option>
                                    <option value="9">septiembre</option>
                                    <option value="10">octubre</option>
                                    <option value="11">noviembre</option>
                                    <option value="12">diciembre</option>
                                    <option value="0">actualmente</option>
                                </select>
                                <input type="text" name="f2anio" class="conborde text-center" placeholder="Año"  maxlength="4" size="4" >

                            </div>    
                        </div>                       
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descripción</label><br>
                                <textarea name="desc" class="form-control" rows="5"></textarea>
                            </div>    
                        </div>                      
                    </div>
                </div>
                <!-- Este es el pie del modal -->
                <div class="modal-footer">  
                    <input type="hidden" name="token" value="<?php echo $estudiantecl->generarToken('nuevaexp');?>">                  
                    <input type="reset" class="btn btn-warning" name="limpiar" value="Limpiar">
                    <input type="submit" name="nuevaexp" class="btn btn-green" value="Guardar">
                    <input type="button" class="btn btn-info" data-dismiss="modal" value="Cancelar">
                    <!-- Para cerrar todos los modales con data-dismiss-->
                </div>

            </div>
        </div>
    </div>
</form>
<?php 
/** Obtenermos el buffer con todo el html anterior y limpiamos el buffer**/
$page["modal"][0] = ob_get_clean();


/*Fin Modal Experiencia*/

/*Modal Educación*/

ob_start();
?>
<form method="post">
    <div class="modal fade" id="modaleduc" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Añadir un nuevo estudio</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control " name="tituloeduc" value="" required="required" >
                            </div>    
                        </div>  
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Institución</label>
                                <input type="text" class="form-control " name="institucion" value=""  >
                            </div>    
                        </div>                      
                    </div>                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Período</label><br>
                                <select name="f1mes" class="conborde">
                                    <option value="1">enero</option>
                                    <option value="2">febrero</option>
                                    <option value="3">marzo</option>
                                    <option value="4">abril</option>
                                    <option value="5">mayo</option>
                                    <option value="6">junio</option>
                                    <option value="7">julio</option>
                                    <option value="8">agosto</option>
                                    <option value="9">septiembre</option>
                                    <option value="10">octubre</option>
                                    <option value="11">noviembre</option>
                                    <option value="12">diciembre</option>
                                </select>
                                <input type="text" class="conborde text-center" name="f1anio" placeholder="Año" required="required" maxlength="4" size="4" > - 

                                <select class="conborde selact" name="f2mes">                                        
                                    <option value="1">enero</option>
                                    <option value="2">febrero</option>
                                    <option value="3">marzo</option>
                                    <option value="4">abril</option>
                                    <option value="5">mayo</option>
                                    <option value="6">junio</option>
                                    <option value="7">julio</option>
                                    <option value="8">agosto</option>
                                    <option value="9">septiembre</option>
                                    <option value="10">octubre</option>
                                    <option value="11">noviembre</option>
                                    <option value="12">diciembre</option>
                                    <option value="0">actualmente</option>
                                </select>
                                <input type="text" name="f2anio" class="conborde text-center" placeholder="Año"  maxlength="4" size="4" >

                            </div>    
                        </div>  
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nivel</label><br>
                                <select class="conborde" name="nivel" required>
                                   <!--<option value="1">Fp básica</option>
                                    <option value="2">Grado medio</option>
                                    <option value="3">Bachillerato</option>
                                    <option value="4">Grado superior</option>
                                    <option value="5">Grado Universitario</option>
                                    <option value="6">Máster</option>
                                    <option value="7">Certificado oficial</option>
                                    <option value="8">otro</option>-->
                                    <?php echo $estudiantecl->listarEnum("formacion_clasificacion","formacion"); ?>
                                </select>
                            </div>    
                        </div>                     
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descripción</label><br>
                                <textarea name="desc" class="form-control" rows="5"></textarea>
                            </div>    
                        </div>                      
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="token" value="<?php echo $estudiantecl->generarToken('nuevaform');?>">  
                    <input type="reset" class="btn btn-warning" name="limpiar" value="Limpiar">
                    <input type="submit" name="nuevaform" class="btn btn-green" value="Guardar">
                    <input type="button" class="btn btn-info" data-dismiss="modal" value="Cancelar">

                </div>

            </div>
        </div>
    </div>
</form>
<?php
$page["modal"][1] = ob_get_clean();

/*Fin Modal educ*/
/* Modal Idioma */

ob_start();
?>
<form method="post">
    <div class="modal fade" id="modalidioma" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Añadir un nuevo idioma</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Idioma</label>
                                <select name="idioma" class="form-control" required>
                                    <?php echo $estudiantecl->listarIdiomas(true); ?>
                                </select>
                            </div>    
                        </div>                     

                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Hablado</label>
                                <select name="nvh" class="form-control " required>
                                    <option disabled selected value=''> -- Selecciona una opción -- </option>
                                    <option value="1">Bajo</option>
                                    <option value="2">Intermedio</option>
                                    <option value="3">Alto</option>
                                    <option value="4">Bilingüe</option>
                                </select>
                            </div>    
                        </div>  
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label>Escrito</label>
                                <select name="nve" class="form-control " required>
                                    <option disabled selected value=''> -- Selecciona una opción -- </option>
                                    <option value="1">Bajo</option>
                                    <option value="2">Intermedio</option>
                                    <option value="3">Alto</option>
                                    <option value="4">Bilingüe</option>
                                </select>
                            </div>    
                        </div>                     
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="token" value="<?php echo $estudiantecl->generarToken('nuevoidioma');?>">                      
                    <input type="reset" class="btn btn-warning" name="limpiar" value="Limpiar">
                    <input type="submit" name="nuevoidioma" class="btn btn-green" value="Guardar">
                    <input type="button" class="btn btn-info" data-dismiss="modal" value="Cancelar">
                </div>

            </div>
        </div>
    </div>
</form>
<?php

$page["modal"][2] = ob_get_clean();
/* Fin Modal idioma */

ob_start();
$informacion = $estudiantecl->listarInformacion();
?>

<h1>Perfil</h1>
<!--Panel Datos Personales -->
<form method="post" enctype="multipart/form-data">
    <div class="panel panel-default">        
        <div class="panel-heading" data-toggle="collapse" data-target=".collinfo">
            <h4>Información del perfil </h4> 
        </div>
        <div class="panel-body collapse in collinfo">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nombre</label>                        
                        <input type="text" class="form-control " id="nombre" name="nombre" maxlength="25" value="<?php if(isset($informacion["nombre"])){echo $informacion["nombre"];}?>" autofocus="autofocus" required="required" >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="50" value="<?php if(isset($informacion["apellidos"])){echo $informacion["apellidos"];}?>">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" id="telefono" minlength="9" maxlength="9" size="9" name="telefono" value="<?php if(isset($informacion["telefono"])){echo $informacion["telefono"];}?>" >
                    </div>
                </div>                   
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Provincia</label>
                        <select id='provincias' class='form-control' name='provincia'>
                            <?php
                            $n = -1;
                            if(isset($informacion["provincia"])&& is_numeric($informacion["provincia"]) && $informacion["provincia"] >0 ){
                                $n = $informacion["provincia"];}
                                $estudiantecl->listarProvincias($n);
                                echo $estudiantecl->provinciasSELECT; ?>
                            </select>
                        </div>
                    </div>           
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Población</label>
                            <input type="text" class="form-control" name="poblacion" value="<?php if(isset($informacion["poblacion"])){echo $informacion["poblacion"];}?>" >
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Código Postal</label>
                            <input type="text" class="form-control" id="cpostal" minlength="5"  maxlength="5" size="5" name="cpostal" value="<?php if(isset($informacion["cod_postal"])){echo $informacion["cod_postal"];}?>" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">                               
                            <label>Fotografía de perfil (Alto y Ancho de 90px)</label><br>
                            <input type="button" value="Seleccionar Archivo" class="btn btn-info" onclick="document.getElementById('fotop').click();">
                            <input type="file" id="fotop" name="fotop" style="display:none"> 
                            <input type="hidden" id="dirfotop" value="<?php if(isset($informacion["fotografia"])){echo $informacion["fotografia"];}?>">                       
                            <input type="button" class="btn btn-primary" id="mostrarf"  value="Mostrar fotografía">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Currículum Vitae (Sólo pdf hasta 500KB)</label><br>
                            <input type="button" value="Seleccionar Archivo" class="btn btn-info" onclick="document.getElementById('cv').click();">
                            <input type="file" id="cv" name="cv" style="display:none">
                            <?php if(isset($informacion["curriculum"])){?> 
                            <input type="hidden" id="dircv" value="<?php if(isset($informacion["curriculum"])){echo $informacion["curriculum"];}?>">
                            <input type="button" class="btn btn-primary" id="mostrarcv" value="Mostrar CV">
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Descripción personal</label>
                            <textarea class="form-control" rows="5" name="descpersonal"><?php if(isset($informacion["descripcion"])){echo $informacion["descripcion"];}?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Carnet de conducir</label>
                            <div class="input-group">  
                                <span class="input-group-addon">                                
                                    <input type="checkbox" name="carnet" 
                                    <?php if(isset($informacion["carnet"]) && $informacion["carnet"]){
                                        echo "checked";}?>
                                        >
                                    </span>
                                    <input type="text" class="form-control" value="Tengo carnet de conducir" disabled="disabled">
                                </div>
                            </div>                        
                        </div> 
                    </div>
                </div>
                <div class="panel-footer collapse in collinfo" >
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input type="hidden" name="token" value="<?php echo $estudiantecl->generarToken('guardarinfo');?>">                  
                            <input type="reset" class="btn btn-warning" name="limpiar" value="Limpiar">
                            <input type="submit" id="guardar" name="guardarinfo" value="Guardar" class="btn btn-green">
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <!-- Fin panel Datos Personales -->
        <!-- Panel Actualizar Contraseña -->
        <form method="post">
            <div class="panel panel-default">

                <div class="panel-heading" data-toggle="collapse" data-target=".collcontr">
                    <h4>Cambiar Contraseña</h4> 
                </div>
                <div class="panel-body collapse collcontr">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contraseña actual</label>
                                <input type="password" class="form-control"  name="contr" id="contr" value="" required="required" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nueva contraseña</label>
                                <input type="password" class="form-control" name="ncontr" id="ncontr" value="" required="required">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Confirma la contraseña</label>
                                <input type="password" class="form-control"  name="ccontr" id="ccontr" value="" required="required">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer collapse collcontr">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input type="hidden" name="token" value="<?php echo $estudiantecl->generarToken('modcontr');?>">                  
                            <input type="submit" name="modcontr" id="modcontr" class="btn btn-green" value="Renovar">
                        </div>
                    </div>
                </div>

            </div>
        </form>

        <!-- Fin panel Actualizar Contraseña -->
        <!-- Experiencia -->        
        <div class="panel panel-default">
            <div class="panel-heading" data-toggle="collapse" data-target=".collexp">
                <h4>Experiencia</h4> 
            </div>
            <div class="panel-body collapse collexp">
                <?php echo $estudiantecl->listarExperiencia(); ?>

            </div>
            <div class="panel-footer collapse collexp">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="button" id="nexp" class="btn btn-green" data-toggle="modal" data-target="#modalexp">Añadir otro puesto de trabajo</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fin de Experiencia -->
        <!-- Educación -->
        <div class="panel panel-default">
            <div class="panel-heading" data-toggle="collapse" data-target=".colleduc">
                <h4>Educación</h4> 
            </div>
            <div class="panel-body collapse colleduc">
                <?php echo $estudiantecl->listarFormacion(); ?>

            </div>
            <div class="panel-footer collapse colleduc">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="button"  class="btn btn-green" data-toggle="modal" data-target="#modaleduc">Añadir otra educación</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Educación -->
        <!-- Skills -->
        <form method="POST">
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-target=".collskills">
                    <h4>Etiquetas</h4> 
                </div>
                <div class="panel-body collapse collskills">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Etiquetas</label>
                                <div class="input-group">
                                    <select class="form-control" id="etiquetas" name="etiqueta">

                                        <?php /*echo $estudiantecl->listarEtiquetas();*/
                                        echo $estudiantecl->listarEtiquetasSelect(); ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <input class="btn btn-success" id="ageex" name="ageex" type="button" value="Agregar etiqueta">
                                    </span>
                                </div>               
                            </div>
                        </div>           

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Agregar una nueva etiqueta</label> 
                                <div class="input-group">
                                    <input type="text" class="form-control" id="etiquetasinput" placeholder="etiqueta">
                                    <span class="input-group-btn">
                                        <input class="btn btn-success" id="ageet" name="agreet" type="button" value="Agregar etiqueta">
                                    </span>
                                </div>                           
                            </div>                        
                        </div>                    
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tus etiquetas</label> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-lg-12 conborde etiquetas">
                                <div class="row" id="divetiquetas">
                        <!--<div class="col-md-4 col-lg-3 form-group" id="php">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox" name="php" value="php">
                                </span>
                                <input type="text" class="form-control" value="php" disabled="disabled">
                            </div>
                        </div>-->                    
                        <?php echo $estudiantecl->listarEtiquetasEst();?>
                    </div> 
                </div>
            </div>
        </div>                                 
    </div>
    <div class="panel-footer collapse collskills">
        <div class="row">
            <div class="col-md-12 text-right">
                <input type="hidden" name="token" value="<?php echo $estudiantecl->generarToken('guardaretiquetas');?>">  
                <input type="button"  class="btn btn-danger" id="eliminarskills" name="eliminarskills" value="Eliminar selección">
                <input type="submit"  class="btn btn-green" name="guardaretiquetas" value="Guardar Skills">
            </div>
        </div>
    </div>
</div>
</form>

<!-- Fin Skills -->
<!-- Idiomas -->
<div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-target=".collidiomas">
        <h4>Idiomas</h4> 
    </div>
    <div class="panel-body collapse collidiomas">
        <div class="row">                        
            <div class="col-xs-4">
                <h4>Idioma</h4>
            </div>                 
            <div class="col-xs-4">
                <h4>Hablado</h4>

            </div>
            <div class="col-xs-4">
                <h4>Escrito</h4>

            </div>
        </div>
        <?php $estudiantecl->listarIdiomas();?>

    </div>

    <div class="panel-footer collapse collidiomas">
        <div class="row">
            <div class="col-md-12 text-right">
                <button type="button"  class="btn btn-green" data-toggle="modal" data-target="#modalidioma">Añadir otro idioma</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Idiomas -->

<!-- Eliminar cuenta -->
<div class="panel panel-danger">
    <div class="panel-heading text-right">
        <form id="eliminarcuenta" method="post">
            <input type="hidden" name="token" value="<?php echo $estudiantecl->generarToken('elusuario');?>">  
            <input type="submit" name="elusuario" class="btn btn-danger" value="Eliminar cuenta">
        </form>
    </div>
</div>
<!-- Fin eliminar cuenta-->

<?php 
/** Guardamos el buffer del cuerpo del perfil **/
$page["cuerpo"] = ob_get_clean();
/**Llamada a la función perfil definida en el fichero /js/tetuanjobs.js
Se le llama en el cuerpo en las últimas líneas**/
ob_start();?>
<script type="text/javascript">
perfilEstudiante();
<?php 
if(isset($_SESSION["etiquetas"])){
    echo 'agregarEtiquetas('.$_SESSION["etiquetas"].',elementosreq);';
    unset($_SESSION["etiquetas"]);
}
?>
</script>
<?php
$page["js"] = ob_get_clean();

/** Incluimos el fichero cuerpo **/
include_once("cuerpo.php");
?>
