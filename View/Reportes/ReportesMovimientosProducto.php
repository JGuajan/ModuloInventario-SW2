<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['USUARIO_ACTIVO'])) {
    include_once '../../Model/CabeceraAjuste.php';
    include_once '../../Model/AjustesModel.php';
    include_once '../../Model/Producto.php';
    include_once '../../Model/ProductosModel.php';
    $ajustesModel = new AjustesModel();
    $productosModel = new ProductosModel();
    $NOM = $_SESSION['NOMBRE_USUARIO'];
    $TIPO = $_SESSION['TIPO_USUARIO'];
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>REPORTE DE MOVIMIENTOS DE PRODUCTO</title>
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

            <style type="text/css">
                div{
                    font-family: Calibri Light;
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
                                    <li><a href="../login.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión </a></li>
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
                                <img src="../../View/Imagenes/banner6.jpg" width="100%" alt="Imagen 1">
                            </div>
                            <div class="item active">
                                <img src="../../View/Imagenes/banner3.png" width="100%" alt="Imagen 2">
                            </div>
                            <div class="item">
                                <img src="../../View/Imagenes/banner1.jpg" width="100%" alt="Imagen 3">
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
                                        <li><a href="ReportesMovimientosProducto.php">Reportes de Movimientos</a></li>
                                        <li><a href="ReporteBodegueros.php">Reportes de Bodegueros</a></li>
                                        <li><a href="ReporteProductos.php">Reportes de Productos</a></li>
                                        <li><a href="ReportesFacturacion.php">Web Service de Ventas</a></li>
                                        <li><a href="ReportesCompras.php">Web Service de Compras</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <h1><span class="glyphicon glyphicon-file"></span>REPORTE DE MOVIMIENTOS DE PRODUCTO</h1></div>
                </div>

                <!--Reporte de Movimientos del producto-->
                <center>
                    <div class="panel panel-default">
                        <div class="panel-heading">SELECCIONE EL PRODUCTO</div>
                        <div class="panel-body">
                            <div class="form-inline">
                                <div class="form-group">
                                    <form action="../../Controller/controller.php?opcion1=ajuste&opcion2=listar_detalles_ajustes" method="POST">
                                        <center>
                                            <label>PRODUCTO:</label>
                                            <select name="ID_PROD" id="ID_PROD" class="form-control" required>
                                                <option value="" disabled selected>Seleccione un Producto</option>
                                                <?php
                                                $listaProductos = $productosModel->getProductos();
                                                foreach ($listaProductos as $prod) {
                                                    echo "<option value='" . $prod->getID_PROD() . "'>" . "Producto: " . $prod->getNOMBRE_PROD() . " Stock: " . $prod->getSTOCK_PROD() . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <br><br>
                                            <label>FILTRAR INFORMACIÓN DESDE:</label><br>
                                            <input type="date" name="FECHA_IN" value="<?php echo date("2017-06-30"); ?>" min="2017/06/30" max="<?php echo date("Y-m-d"); ?>" required>
                                            <label>HASTA:</label>                                
                                            <input type="date" name="FECHA_FIN" value="<?php echo date("Y-m-d"); ?>" min="2017/06/30" max="<?php echo date("Y-m-d"); ?>" required>
                                            <br><br>
                                        </center>
                                        <button type="submit" class="btn btn-info">
                                            <span class="glyphicon glyphicon-search"></span> CONSULTAR
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <hr size="100">
                            <center><h3 id="Titulo"><span class="glyphicon glyphicon-list-alt"></span> REPORTES</h3></center>        
                            <br>
                            <label>DETALLES DE AJUSTES DEL PRODUCTO:</label>                                               
                            <table class="table table-striped table-bordered table-condensed table-hover" data-toggle="table" data-pagination="true" id="TblDetAjuProd">
                                <thead>
                                    <tr> 
                                        <th>CÓDIGO AJUSTE</th>
                                        <th>CÓDIGO DETALLE</th>
                                        <th>USUARIO</th>
                                        <th>CANTIDAD</th>
                                        <th>TIPO MOVIMIENTO</th>
                                    </tr>
                                </thead>
                                <?php
                                if (isset($_SESSION['listadoDetallesAjustes'])) {
                                    $listadoDetallesAjustes = unserialize($_SESSION['listadoDetallesAjustes']);
                                    foreach ($listadoDetallesAjustes as $rep) {
                                        if ($rep->getTIPOMOV_DETAJUSTE_PROD() == "I") {
                                            $tipoMov = "INGRESO";
                                        } else {
                                            $tipoMov = "SALIDA";
                                        }
                                        ?>
                                        <tbody>
                                            <?php
                                            echo "<tr class = 'info'>
                                        <td>" . $rep->getID_AJUSTE_PROD() . "</td>
                                        <td>" . $rep->getID_DETALLE_AJUSTE_PROD() . "</td>
                                        <td>" . $rep->getNOMAPE_USU() . "</td>
                                        <td>" . $rep->getCAMBIO_STOCK_PROD() . "</td>
                                        <td>" . $tipoMov . "</td>
                                        </tr>";
                                        }
                                        echo '</tbody>';
                                    }
                                    ?>
                            </table>
                            <br>
                        </div>
                    </div>
                </center>
            </div>
        </body>
    </html>
    <?php
} else {
    header('Location: ../Principal/iniciop.php');
}
?>