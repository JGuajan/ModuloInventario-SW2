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
            <script language="javascript">
                function ObtenerDatosProducto(ID_PROD) {
                    var ID_PROD = ID_PROD;
                    /// Invocamos a nuestro script PHP
                    $.ajax({
                        data: ID_PROD,
                        url: '../../controller/controller.php?opcion1=ajuste&opcion2=recargarDatosProducto&ID_PROD=' + ID_PROD,
                        type: 'post',
                        success: function (response) {
                            $("#TblProd").html(response);
                        }
                    });
                }
            </script>
            <script language="javascript">
                function obtenerTituloReporteProducto(ID_PROD) {
                    var ID_PROD = ID_PROD;
                    /// Invocamos a nuestro script PHP
                    $.ajax({
                        data: ID_PROD,
                        url: '../../controller/controller.php?opcion1=ajuste&opcion2=obtener_titulo&ID_PROD=' + ID_PROD,
                        type: 'post',
                        success: function (response) {
                            $("#Titulo").html(response);
                        }
                    });
                }
            </script>
            <script language="javascript">
                function obtenerTablaDetallesAjustesProd(ID_PROD, FECHA_IN, FECHA_FIN) {
                    var ID_PROD = ID_PROD;
                    var FECHA_IN = FECHA_IN;
                    var FECHA_FIN = FECHA_FIN;
                    /// Invocamos a nuestro script PHP
                    $.ajax({
                        data: ID_PROD,
                        url: '../../controller/controller.php?opcion1=ajuste&opcion2=listar_detalles_ajustes&ID_PROD=' + ID_PROD
                                + '&FECHA_IN=' + FECHA_IN + '&FECHA_FIN=' + FECHA_FIN,
                        type: 'post',
                        success: function (response) {
                            $("#TblDetAjuProd").html(response);
                        }

                    });
                }
            </script>
            <script language="javascript">
                function obtenerTablaDetallesFacVentas(ID_PROD, FECHA_IN, FECHA_FIN) {
                    var ID_PROD = ID_PROD;
                    var FECHA_IN = FECHA_IN;
                    var FECHA_FIN = FECHA_FIN;
                    /// Invocamos a nuestro script PHP
                    $.ajax({
                        data: ID_PROD,
                        url: '../../controller/controller.php?opcion1=ajuste&opcion2=listar_detalles_fact_venta&ID_PROD=' + ID_PROD
                                + '&FECHA_IN=' + FECHA_IN + '&FECHA_FIN=' + FECHA_FIN,
                        type: 'post',
                        success: function (response) {
                            $("#TblDetFacVenta").html(response);
                        }

                    });
                }
            </script>
            <script language="javascript">
                function obtenerTablaDetallesFacCompras(ID_PROD, FECHA_IN, FECHA_FIN) {
                    var ID_PROD = ID_PROD;
                    var FECHA_IN = FECHA_IN;
                    var FECHA_FIN = FECHA_FIN;
                    /// Invocamos a nuestro script PHP
                    $.ajax({
                        data: ID_PROD,
                        url: '../../controller/controller.php?opcion1=ajuste&opcion2=listar_detalles_fact_compra&ID_PROD=' + ID_PROD
                                + '&FECHA_IN=' + FECHA_IN + '&FECHA_FIN=' + FECHA_FIN,
                        type: 'post',
                        success: function (response) {
                            $("#TblDetFacCompra").html(response);
                        }

                    });
                }
            </script>
            <script language="javascript">
                function console_log($data) {
                    console.log($data);
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
                                <img src="../../View/Imagenes/banner6.jpg" width="100%" alt="Imagen 1">
                            </div>
                            <div class="item active">
                                <img src="../../View/Imagenes/banner11.jpg" width="100%" alt="Imagen 2">
                            </div>
                            <div class="item">
                                <img src="../../View/Imagenes/banner10.jpg" width="100%" alt="Imagen 3">
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


                <div class="row">
                    <div class="col-lg-12">
                        <h1><span class="glyphicon glyphicon-file"></span>REPORTE DE MOVIMIENTOS DE PRODUCTO</h1></div>
                </div>

                <!--Reporte de Movimientos del producto-->
                <div class="panel panel-default">
                    <div class="panel-heading">SELECCIONE EL PRODUCTO</div>
                    <div class="panel-body">

                        <!--Formulario para llenar Tablas de reporte del producto-->
                        <form action="../../Controller/controller.php">
                            <center>
                                <input type="hidden" name="opcion1" value="ajuste">
                                <div class="form-inline">
                                    <div class="form-group">

                                        <label>PRODUCTO:</label>
                                        <select name="ID_PROD" id="CboIDProducto" class="form-control" onchange="ObtenerDatosProducto($('#CboIDProducto').val());
                                                return false;" required>

                                            <option value="" disabled selected>Seleccione un Producto</option>
                                            <?php
                                            $listaProductos = $productosModel->getProductos();
                                            foreach ($listaProductos as $prod) {
                                                echo "<option value='" . $prod->getID_PROD() . "'>" . $prod->getNOMBRE_PROD() . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <br><br>                            
                                        <label>FILTRAR INFORMACIÓN DESDE:</label><br>
                                        <input type="date" name="FECHA_IN" id="FechaIn" value="2017/06/30" min="2017/06/30" max="<?php echo date("Y-m-d"); ?>" required>
                                        <label>HASTA:</label>                                
                                        <input type="date" name="FECHA_FIN" id="FechaFin" value="<?php echo date("Y-m-d"); ?>" min="2017/06/30" max="<?php echo date("Y-m-d"); ?>" required>
                                        </center><br><br>
                                        <table class="table table-striped table-bordered table-condensed table-hover" data-toggle="table" data-pagination="true" id="TblProd">
                                            <thead>
                                                <tr> 
                                                    <th>PRODUCTO</th>
                                                    <th>PRECIO</th>
                                                    <th>GRAVA IVA</th>
                                                    <th>STOCK</th>
                                            </thead>
                                        </table>
                                        <center><br>
                                            <button type="submit" class="btn btn-info" onclick="obtenerTablaDetallesAjustesProd($('#CboIDProducto').val(), $('#FechaIn').val(), $('#FechaFin').val());
                                                    obtenerTablaDetallesFacVentas($('#CboIDProducto').val(), $('#FechaIn').val(), $('#FechaFin').val());
                                                    obtenerTablaDetallesFacCompras($('#CboIDProducto').val(), $('#FechaIn').val(), $('#FechaFin').val());
                                                    obtenerTituloReporteProducto($('#CboIDProducto').val());
                                                    return false;">
                                                <span class="glyphicon glyphicon-search"></span> CONSULTAR
                                            </button>
                                    </div>
                                </div>   
                            </center>
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
                            </table>
                            <br><br>
                            <label>DETALLES DE FACTURAS DE VENTA DEL PRODUCTO:</label>
                            <table class = "table table-striped table-bordered table-condensed table-hover" data-toggle = "table" data-pagination = "true" id="TblDetFacVenta">
                                <thead>
                                    <tr>
                                        <th>CANTIDAD</th>
                                        <th>CÓDIGO FACTURA</th>
                                        <th>CÓDIGO DETALLE</th>
                                        <th>DESCRIPCIÓN</th>
                                        <th>VAL.UNIT</th>
                                        <th>VAL.TOT</th>
                                    </tr>
                                </thead>
                            </table>
                            <br><br>
                            <label>DETALLES DE FACTURAS DE COMPRA DEL PRODUCTO:</label>
                            <table class = "table table-striped table-bordered table-condensed table-hover" data-toggle = "table" data-pagination = "true" id="TblDetFacCompra">
                                <thead>
                                    <tr>
                                        <th>CANTIDAD</th>
                                        <th>CÓDIGO FACTURA</th>
                                        <th>CÓDIGO DETALLE</th>
                                        <th>DESCRIPCIÓN</th>
                                        <th>VAL.UNIT</th>
                                        <th>VAL.TOT</th>
                                    </tr>
                                </thead>
                            </table>
                            <br>
                            <!--Tabla de detalles del ajuste-->

                        </form>
                        <!--Fin de las Tablas de reporte del prodcuto-->

                    </div>
                </div>
                <!--Fin Reporte de Movimientos del producto-->
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    header('Location: ../View/Principal/iniciop.php');
}
?>