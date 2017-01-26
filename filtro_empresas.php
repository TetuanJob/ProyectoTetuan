<?php
$page["nombrePag"] = "Filtro de empresas";
include_once("funciones/generalF.php");
session_start();

if(!isset($_SESSION["usuario"])){
    header("location:login.php");
}else if($_SESSION["usuario"]->tipo != "administrador"){
    header("location:dashboard.php");
}
include_once("funciones/adminF.php");
$adminclass = new adminBBDD;
$adminclass->eliminarEmpresas();
$adminclass->modificarEmpresas();

ob_start();?>
<script type="text/javascript">
filtroem();

</script>
<?php
$page["js"] = ob_get_clean();

ob_start();
?>
<h1 >Filtro de empresas
</h1>
<!-- Panel resultados -->

<div class="panel panel-default">
    <form method="post">
        <div class="panel-heading">
            <!--<h4>Resultados de la búsqueda</h4> -->
            <h4>Buscar empresa</h4>
        </div>
        <div class="panel-body">
            <table id="resempresas" class="display t-responsive" cellspacing="0" width="100%">
             <thead>
                <tr>
                    <th><i class="fa fa-list-ul" aria-hidden="true"></i></th>
                    <th>Empresa</th>
                    <th>Web</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Contacto</th>                
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><i class="fa fa-list-ul" aria-hidden="true"></i></th>
                    <th>Empresa</th>
                    <th>Web</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Contacto</th>                
                </tr>
            </tfoot>
            <tbody>
                <?php 
                $adminclass->listarEmpresas();                
                ?>
                <tr>
                    <td><button type="submit" name="agregaremp" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button></td>
                    <td><input type="text" name="nemp" ></td>
                    <td><input type="text" name="webemp"></td>
                    <td><input type="text" name="mailemp" ></td>
                    <td><input type="text" name="telfemp"></td>
                    <td><input type="text" name="contemp"></td>
                </tr>
            </tbody>
        </table>               
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-12 text-right">
                <input type="submit" class="btn btn-danger" name="eliminaremp" value="Eliminar selección">
                <input type="submit" name="modificaremp" value="Modificar selección" class="btn btn-success">
            </div>
        </div>
    </div>
</form>
</div>   

<!-- Fin Panel resultados -->




<?php
$page["cuerpo"] = ob_get_clean();
/** Incluimos el fichero cuerpo **/
include_once("cuerpo.php");
?>
