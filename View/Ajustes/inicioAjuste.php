<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['USUARIO_ACTIVO'])) {
    include_once '../../Model/CabeceraAjuste.php';
    include_once '../../Model/AjustesModel.php';
    $ajustesModel = new AjustesModel();
    $NOM = $_SESSION['NOMBRE_USUARIO'];
    $TIPO = $_SESSION['TIPO_USUARIO'];
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Ajustes</title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				

            <!--Importación de Bootstrap al proyecto-->
            <script src="../../Bootstrap/js/jquery-2.1.4.js"></script>
            <script src="../../Bootstrap/js/bootstrap.js"></script>
            <script src="../../Bootstrap/js/bootstrap-table.js"></script>
            <script src="../../Bootstrap/js/getDatos.js"></script>
            <link href="../../Bootstrap/css/bootstrap.css" rel="stylesheet" />
            <link href="../../Bootstrap/css/bootstrap-table.css" rel="stylesheet">
            <link rel="../../stylesheet" href="Bootstrap/css/bootstrap-theme.css">
            <script src="../../Bootstrap/js/validaciones.js"></script>

            <script src = "../../SweetAlert/sweetalert.min.js" type="text/javascript"></script>
            <link href="../../SweetAlert/sweetalert.css" rel="stylesheet" type="text/css">
            <style type="text/css">
                div{
                    font-family: Calibri Light;
                }
                body{
                    padding-top: 50px;
                }
            </style>
            <script LANGUAGE="JavaScript">
                function confirImprimir(cod, mot, fec)
                {
                    var a = "\n\nCODIGO: " + cod + "\nMOTIVO: " + mot + "\nFECHA: " + fec + "\n"
                    var b = "\nUna vez impreso este ajuste ya no se lo podrá editar, ¿Desea continuar?";
                    var agree = confirm("ADVERTENCIA:\n\nIMPRESIÓN DEL AJUSTE " + a + b);
                    if (agree)
                        return  true;
                    else
                        return false;
                }
            </script>
        </head>
        <body>
            <div class="container-fluid">
                <!--CODIGO PARA LA BARRA DE SESIÓN-->
                <div class="row">
                    <nav class="navbar navbar-inverse navbar-fixed-top">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1">
                                    <span class="sr-only">Menú</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                                <a href="" class="navbar-brand">MÓDULO DE INVENTARIO</a>
                            </div>
                            <div class="collapse navbar-collapse" id="navbar-1">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href=""><span class="glyphicon glyphicon-user"></span> <?php echo $NOM; ?> </a></li>
                                    <li><a href=""><span class="glyphicon glyphicon-edit"></span> <?php echo $TIPO; ?> </a></li>
                                    <li><a href="../../Controller/controller.php?opcion1=cerrar_sesion"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesion </a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>

                <!--CODIGO PARA INSERTAR  UN SLIDER-->
                <div class="row">
                    <div id="carousel1" class="carousel slide" data-ride="carousel">
                        <!--Indicatodores--> 
                        <ol class="carousel-indicators">
                            <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel1" data-slide-to="1"></li>
                            <li data-target="#carousel1" data-slide-to="2"></li>
                        </ol> 

                        <!--Contenedor de las imagenes--> 
                        <div class="carousel-inner" role="listbox">
                            <div class="item">
                                <img src="../../View/Imagenes/banner4.jpg" width="100%" alt="Imagen 1">
                            </div>
                            <div class="item active">
                                <img src="../../View/Imagenes/banner9.jpg" width="100%" alt="Imagen 2">
                            </div>
                            <div class="item">
                                <img src="../../View/Imagenes/banner3.png" width="100%" alt="Imagen 3">
                            </div>
                        </div>
                        <!--Controls--> 
                        <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                </div>

                <!--TITULO DEL SISTEMA-->
                <div class="row text-center">
                    <h3>SISTEMA DE MÓDULO DE INVENTARIO</h3>
                </div>

                <!--MENU CON BOTONES-->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="btn-toolbar">
                            <div class="btn-group btn-group-justified">
                                <a class="btn btn-danger alert-danger  " href="../Principal/iniciop.php">INICIO</a>
                                <a class="btn btn-primary" href="../../View/Ajustes/inicioAjuste.php">AJUSTES</a>
                                <a class="btn btn-primary" href="../../View/Producto/inicioProductos.php">PRODUCTOS</a>
                                <a class="btn btn-primary" href="../../View/Usuario/inicioUsuarios.php">USUARIOS</a>
                                <div class="btn-group">
                                    <button class="btn btn-primary dropdown-toggle" id="dropdownReportes" aria-extended="true" type="button" data-toggle="dropdown">
                                        <label class="control-label">Reportes <span class="caret"></span></label>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownReportes">
                                        <li><a href="../../View/Reportes/ReportesMovimientosProducto.php">Reportes de Movimientos</a></li>
                                        <li><a href="../../View/Reportes/ReporteBodegueros.php">Reportes de Bodegueros</a></li>
                                        <li><a href="../../View/Reportes/ReporteProductos.php">Reportes de Productos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Título de la página-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12" style="border-bottom: 1px solid #c5c5c5">
                            <h1><span class="glyphicon glyphicon-cog"></span> AJUSTES</h1></div>
                    </div>
                </div>

                <!--La clase col nos permite que la pagina sea responsive mediante numero de columnas
                     donde el total de columnas es 12 y
                     donde lg es en tamaño de escritorio, md medianos, sm tablets, xs celulares -->

                <div class="row">
                    <div class="col-md-12" style="padding-top: 5px">
                        <!--La class nav nav-pills nos permite hacer menús-->
                        <ul class="nav nav-pills">
                            <li role="presentation"><a href="../../Controller/controller.php?opcion1=ajuste&opcion2=listar_ajustes"><h4>MOSTRAR TODOS</h4></a></li>
                            <!--                            <li role="presentation"><a href="#nuevoAJU" data-toggle="modal"><h4>NUEVO AJUSTE</h4></a></li>-->
                            <li role="presentation"><a href="../../Controller/controller.php?opcion1=ajuste&opcion2=nuevo_ajuste" data-toggle="modal"><h4>NUEVO AJUSTE</h4></a></li>
                            <!--<li role="presentation"><a href="nuevoAjuste.php"><h4>NUEVO AJUSTE</h4></a></li>-->
                        </ul>
                    </div>
                </div>

                <?php
                if (isset($_SESSION['ErrorBaseDatos'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['ErrorBaseDatos'] . "</div>";
                }
                ?>

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><h4>Lista de Ajustes</h4></div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <script src="../../Bootstrap/DataTables/ajustes.js"></script>
                                        <script src="../../Bootstrap/DataTables/jquery-1.12.4.js"></script>
                                        <script src="../../Bootstrap/DataTables/jquery.dataTables.min.js"></script>
                                        <link rel="stylesheet" href="../../Bootstrap/DataTables/jquery.dataTables.min.css">
                                        <table class="table table-striped table-bordered table-condensed table-condensed" id="example" cellspacing="0" width="100%">
                                            <thead>
                                                <tr> 
                                                    <th colspan="2">ACCIONES</th>
                                                    <th>CODIGO AJUSTE</th>
                                                    <th>MOTIVO AJUSTE</th>
                                                    <th>FECHA AJUSTE</th>
                                                    <th>FECHA IMPRESIÓN</th>
                                                    <th>ESTADO DE IMPRESIÓN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Verificamos si existe la variable de sesión que contiene la lista de Usuarios
                                                if (isset($_SESSION['listadoAjustes'])) {
                                                    // Deserializamos y mostraremos los atributos de los usuarios usando un ciclo for
                                                    $listado = unserialize($_SESSION['listadoAjustes']);
                                                    foreach ($listado as $aju) {
                                                        ?>
                                                        <tr>
                                                    <input type="hidden" value="<?php echo $aju->getID_AJUSTE_PROD(); ?>" id="ID_AJUSTE_PROD<?php echo $aju->getID_AJUSTE_PROD(); ?>">
                                                    <input type="hidden" value="<?php echo $aju->getMOTIVO_AJUSTE_PROD(); ?>" id="MOTIVO_AJUSTE_PROD<?php echo $aju->getID_AJUSTE_PROD(); ?>" >
                                                    <input type="hidden" value="<?php echo $aju->getFECHA_AJUSTE_PROD(); ?>" id="FECHA_AJUSTE_PROD<?php echo $aju->getID_AJUSTE_PROD(); ?>" >

                                                    <td align="center"><a onclick="return confirImprimir
                                    ('<?php echo $aju->getID_AJUSTE_PROD(); ?>',
                                            '<?php echo $aju->getMOTIVO_AJUSTE_PROD(); ?>',
                                            '<?php echo $aju->getFECHA_AJUSTE_PROD(); ?>');" 
                                                                          href='../../Controller/controller.php?opcion1=ajuste&opcion2=imprimir_ajuste&ID_AJUSTE_PROD=<?php echo $aju->getID_AJUSTE_PROD(); ?>&MOTIVO_AJUSTE_PROD=<?php echo $aju->getMOTIVO_AJUSTE_PROD(); ?>'>
                                                            <span class='glyphicon glyphicon-print'>Imprimir</span></a></td>
                                                    <td align="center"> 
                                                        <?php
//                                                        erika solo cambiamos s
                                                        if ($aju->getESTADO_IMP_AJUSTE_PROD() == 'S') {
                                                            echo '--';
                                                        } else {
                                                            echo "<a href='../../Controller/controller.php?opcion1=ajuste&opcion2=editar_ajuste&ID_AJUSTE_PROD=" . $aju->getID_AJUSTE_PROD() . "'><span class='glyphicon glyphicon-pencil'>Editar</a>";
//                                                            echo "<a href='#editAJU' onclick='obtener_datos(" . $aju->getID_AJUSTE_PROD() . "') data-toggle='modal'><span class='glyphicon glyphicon-pencil'>Editar</a>";
                                                        }
                                                        ?>
                                                    </td>                                                                                  

                                                    <td><?php echo $aju->getID_AJUSTE_PROD(); ?></td>
                                                    <td><?php echo $aju->getMOTIVO_AJUSTE_PROD() ?></td>
                                                    <td><?php echo $aju->getFECHA_AJUSTE_PROD() ?></td>
                                                    <td><?php echo $aju->getFECHA_IMP_AJUSTE_PROD() ?></td>
                                                    <!--erika ponemos-->
                                                    <td><?php
                                                        if ($aju->getESTADO_IMP_AJUSTE_PROD() == 'S') {
                                                            echo 'IMPRESO';
                                                        } else {
                                                            echo 'NO IMPRESO';
                                                        }
                                                        ?></td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--                Ventana emergente para Nuevo ajuste
                                <div class="modal fade" id="nuevoAJU">
                                    <div class="modal-dialog">
                                        <form class="form-horizontal" action="#ventanasEmergentes">
                                        <form class="form-horizontal" action="../../Controller/controller.php">
                                            <input type="hidden" name="opcion1" value="ajuste">
                                            <input type="hidden" name="opcion2" value="insertar_ajuste">
                                            <div class="modal-content">
                                                 Header de la ventana 
                                                <div class="modal-header bg-success">
                                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h3 class="modal-title"><span class="glyphicon glyphicon-cog"></span> Nuevo Ajuste</h3>
                                                </div>
                
                                                 Contenido de la ventana 
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="col-md-3 col-md-offset-1">
                                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Codigo</label>
                                                                </div>
                                                                <div class="col-md-7">
                <?php echo $ajustesModel->generarCodigoAjuste(); ?>
                                                                    <input type="hidden" name="ID_AJUSTE_PROD" value="<?php echo $ajustesModel->generarCodigoAjuste(); ?>">
                                                                   <input type="text" class="form-control" placeholder="Ingrese sus Apellidos" required />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-md-3 col-md-offset-1">
                                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Motivo </label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input type="text" class="form-control" name="MOTIVO_AJUSTE_PROD" size="150" maxlength="150" placeholder="Ingrese el motivo del ajuste" required />
                                                                </div>
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                </div>
                
                                                 Footer de la ventana 
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    <button class="btn btn-success">Guardar Ajuste</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                -->


                <!--Ventana emergente para Editar ajuste-->
                <div class="modal fade" id="editAJU">
                    <div class="modal-dialog">
                        <!--<form class="form-horizontal" action="#ventanasEmergentes">-->
                        <form class="form-horizontal" action="../../Controller/controller.php">
                            <input type="hidden" name="opcion1" value="ajuste">
                            <input type="hidden" name="opcion2" value="guardar_ajuste">
                            <div class="modal-content">
                                <!-- Header de la ventana -->
                                <div class="modal-header bg-success">
                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title"><span class="glyphicon glyphicon-cog"></span> Editar Ajuste</h3>
                                </div>

                                <!-- Contenido de la ventana -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Codigo</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="hidden" id="mod_id" name="mod_id" value="">
                                                    <p id="mod_cod"></p>
                                                     <!--<input type="txt" id="mod_cod" name="mod_cod" value="">-->
                                                    <!--<input type="text" class="form-control" placeholder="Ingrese sus Apellidos" required />-->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Motivo </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="mod_motivo" name="mod_motivo" size="150" maxlength="150" placeholder="Ingrese el motivo del ajuste" required />
                                                </div>
                                            </div>

                                            <!--                                        <div class="form-group">
                                                                                        <div class="col-md-3 col-md-offset-1">
                                                                                            <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Fecha</label>
                                                                                        </div>
                                                                                        <div class="col-md-7">
                                                                                            <input type="hidden" id="" name="mod_fecha" value="<?php echo gmdate("Y-m-d H:i:s"); ?>">
                                                                                            <p id=""> <?php echo gmdate("Y-m-d H:i:s"); ?></p>
                                                                                </div>
                                                                            </div>-->

                                        </div>
                                    </div>
                                </div>

                                <!-- Footer de la ventana -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button class="btn btn-success">Guardar Ajuste</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    header('Location: ../login.php');
}
?>