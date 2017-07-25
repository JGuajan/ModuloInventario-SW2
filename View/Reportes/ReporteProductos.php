<!DOCTYPE html>

<?php
// Inicio de sesión e inclusión de rutas para acceder a los datos
session_start();
if (isset($_SESSION['USUARIO_ACTIVO'])) {
    include_once '../../Model/Producto.php';
    include_once '../../Model/ProductosModel.php';
    $productoModel = new ProductosModel();
    $NOM = $_SESSION['NOMBRE_USUARIO'];
    $TIPO = $_SESSION['TIPO_USUARIO'];

// Creamos la variable para el llamado de los métodos de la tabla Tipo Usuario y Usuario
//$tiposUsuarioModel = new TiposUsuarioModel();
//$usuariosModel = new UsuariosModel(); 
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Producto</title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				

            <!--Importación de Bootstrap al proyecto-->
            <script src="../../Bootstrap/js/jquery-2.1.4.js"></script>
            <script src="../../Bootstrap/js/bootstrap.js"></script>
            <script src="../../Bootstrap/js/getDatos.js"></script>
            <script src="../../Bootstrap/js/bootstrap-table.js"></script>
            <link href="../../Bootstrap/css/bootstrap-table.css" rel="stylesheet">
            <script src="../../Bootstrap/js/validaciones.js"></script>
            <link href="../../Bootstrap/css/bootstrap.css" rel="stylesheet" />
            <link rel="../../stylesheet" href="Bootstrap/css/bootstrap-theme.css">
            <style type="text/css">
                div{
                    font-family: Calibri Light;
                }
                body{
                    padding-top: 50px;
                }
            </style>
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
                                    <li><a href="../login.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesion </a></li>
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
                                <img src="../../View/Imagenes/banner12.jpg" width="100%" alt="Imagen 1">
                            </div>
                            <div class="item active">
                                <img src="../../View/Imagenes/banner6.jpg" width="100%" alt="Imagen 2">
                            </div>
                            <div class="item">
                                <img src="../../View/Imagenes/banner5.jpg" width="100%" alt="Imagen 3">
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
                            <h1><span class="glyphicon glyphicon-apple"></span>REPORTE DE PRODUCTOS</h1></div>
                    </div>
                </div>

                <!--La clase col nos permite que la pagina sea responsive mediante numero de columnas
                     donde el total de columnas es 12 y
                     donde lg es en tamaño de escritorio, md medianos, sm tablets, xs celulares -->

                <div class="row">
                    <div class="col-md-12" style="padding-top: 5px">
                        <!--La class nav nav-pills nos permite hacer menús-->
                        <ul class="nav nav-pills">
                            <li role="presentation"><a href="../../Controller/controller.php?opcion1=producto&opcion2=listar_productos"><h4>MOSTRAR TODOS</h4></a></li>
                        </ul>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><h4><center> <h2>Reporte de Productos</h2></center></h4></div>
                            <div class="panel-title">
                                <div class="col-lg-12">
                                    <div class="table-striped">
                                         <script src="../../Bootstrap/DataTables/main.js"></script>
                                         <script src="../../Bootstrap/DataTables/jquery-1.12.4.js"></script>
                                         <script src="../../Bootstrap/DataTables/jquery.dataTables.min.js"></script>
                                         <link rel="stylesheet" href="../../Bootstrap/DataTables/jquery.dataTables.min.css">
                                        <!-- Tabla en la que se listaras los productos de la Base de Datos -->
                                        <table class="table table-responsive table-bordered table-striped table-striped" id="example" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>ID PRODUCTO</th>
                                                <th>NOMBRE PRODUCTO</th>
                                                <th>DESCRIPCION DEL PRODUCTO</th>
                                                <th>GRABA IVA</th>
                                                <th>COSTO PRODUCTO</th>
                                                <th>PVP PRODUCTO</th>
                                                <th>ESTADO PRODUCTO</th>
                                                <th>STOCK</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            // Verificamos si existe la variable de sesión que contiene la lista de Productos
                                            if (isset($_SESSION['listadoProductos'])) {
                                                // Deserializamos y mostraremos los atributos de los usuarios usando un ciclo for
                                                $listado = unserialize($_SESSION['listadoProductos']);
                                                foreach ($listado as $pro) {
                                                    $estado = $productoModel->obtenerEstadoProducto($pro->getID_PROD());
                                                    $iva = $productoModel->grabaIva($pro->getID_PROD());
                                                    ?>

                                                    <tr>
                                                        <!--<td align="center"><a onclick="return confirEliminar();" href='../../Controller/controller.php?opcion1=producto&opcion2=eliminar_producto&ID_PROD=<?php echo $pro->getID_PROD(); ?>'><span class='glyphicon glyphicon-remove'>Eliminar</span></a></td>-->                                    
                                                    <input type="hidden" value="<?php echo $pro->getID_PROD(); ?>" id="ID_PROD<?php echo $pro->getID_PROD(); ?>">
                                                    <input type="hidden" value="<?php echo $pro->getNOMBRE_PROD(); ?>" id="NOMBRE_PROD<?php echo $pro->getID_PROD(); ?>">
                                                    <input type="hidden" value="<?php echo $pro->getDESCRIPCION_PROD(); ?>" id="DESCRIPCION<?php echo $pro->getID_PROD(); ?>">
                                                    <input type="hidden" value="<?php echo $pro->getGRAVA_IVA_PROD(); ?>" id="GRABA_IVA_PROD<?php echo $pro->getID_PROD(); ?>">
                                                    <input type="hidden" value="<?php echo $pro->getCOSTO_PROD(); ?>" id="COSTO_PROD<?php echo $pro->getID_PROD(); ?>">
                                                    <input type="hidden" value="<?php echo $pro->getPVP_PROD(); ?>" id="PVP_PROD<?php echo $pro->getID_PROD(); ?>">
                                                    <input type="hidden" value="<?php echo $pro->getESTADO_PROD(); ?>" id="ESTADO_PROD<?php echo $pro->getID_PROD(); ?>">
                                                    <input type="hidden" value="<?php echo $pro->getSTOCK_PROD(); ?>" id="STOCK_PROD<?php echo $pro->getID_PROD(); ?>">
                                                    <td><?php echo $pro->getID_PROD(); ?></td>
                                                    <td><?php echo $pro->getNOMBRE_PROD(); ?></td>
                                                    <td><?php echo $pro->getDESCRIPCION_PROD(); ?></td>
                                                    <td><?php echo $iva; ?></td>
                                                    <td><?php echo $pro->getCOSTO_PROD(); ?></td>
                                                    <td><?php echo $pro->getPVP_PROD(); ?></td>
                                                    <td><?php echo $estado; ?></td>
                                                    <th><?php echo $pro->getSTOCK_PROD(); ?></th>

                                                    </tr>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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