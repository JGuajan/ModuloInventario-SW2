<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    // Inicio de sesión e inclusión de rutas para acceder a los datos
    session_start();

    // Verificamos si existe inicio de sesión
    if (isset($_SESSION['USUARIO_ACTIVO'])) {
        include_once '../../Model/Usuario.php';
        include_once '../../Model/UsuariosModel.php';
        include_once '../../Model/TipoUsuario.php';
        include_once '../../Model/TiposUsuarioModel.php';

        // Deserializamos el usuario en sesión
        $usuarioSesion = unserialize($_SESSION['USUARIO_ACTIVO']);

        // Creamos la variable para el llamado de los métodos de la tabla Tipo Usuario y Usuario
        $tiposUsuarioModel = new TiposUsuarioModel();
        $usuariosModel = new UsuariosModel();
        $NOM = $_SESSION['NOMBRE_USUARIO'];
        $TIPO = $_SESSION['TIPO_USUARIO'];
        ?>
        <head>
            <meta charset="UTF-8">
            <title>Reporte de Bodegueros</title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				

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
                                <img src="../../View/Imagenes/banner1.jpg" width="100%" alt="Imagen 1">
                            </div>
                            <div class="item active">
                                <img src="../../View/Imagenes/banner2.jpg" width="100%" alt="Imagen 2">
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
                <!--TITULO DE LA PAGINA-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12" style="border-bottom: 1px solid #c5c5c5">
                            <h1><span class="glyphicon glyphicon-user"></span> REPORTE DE USUARIOS BODEGUEROS</h1></div>
                    </div>
                </div>

                <!--La clase col nos permite que la pagina sea responsive mediante numero de columnas
                     donde el total de columnas es 12 y
                     donde lg es en tamaño de escritorio, md medianos, sm tablets, xs celulares -->

                <div class="row">
                    <div class="col-md-12" style="padding-top: 5px">
                        <!--La class nav nav-pills nos permite hacer menús-->
                        <ul class="nav nav-pills">
                            <li role="presentation"><a href="../../Controller/controller.php?opcion1=usuario&opcion2=listarBodegueros"><h4>MOSTRAR TODOS</h4></a></li>
                        </ul>
                    </div>
                </div>
                <br>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><h4>Lista de Bodegueros</h4></div>
                            <div class="panel-title">
                                <div class="col-lg-12">
                                    <div class="table-striped">
                                        <!--<script src="../../Bootstrap/DataTables/main.js"></script>-->
                                        <script src="../../Bootstrap/DataTables/usuario.js"></script>
                                        <script src="../../Bootstrap/DataTables/jquery-1.12.4.js"></script>
                                        <script src="../../Bootstrap/DataTables/jquery.dataTables.min.js"></script>
                                        <link rel="stylesheet" href="../../Bootstrap/DataTables/jquery.dataTables.min.css">
                                        <!-- Tabla en la que se listara los usuarios de la Base de Datos -->
                                        <table class="table table-striped table-bordered table-condensed table-condensed" id="example" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>ID USUARIO</th>
                                                    <th>TIPO USUARIO</th>
                                                    <th>CEDULA - RUC</th>
                                                    <th>NOMBRES</th>
                                                    <th>APELLIDOS</th>
                                                    <th>FECHA NACIMIENTO</th>
                                                    <th>CIUDAD NACIMIENTO</th>
                                                    <th>DIRECCION</th>
                                                    <th>TELEFONO</th>
                                                    <th>E-MAIL</th>
                                                    <th>ESTADO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Verificamos si existe la variable de sesión que contiene la lista de Usuarios
                                                if (isset($_SESSION['listadoUsuariosB'])) {
                                                    // Deserializamos y mostraremos los atributos de los usuarios usando un ciclo for
                                                    $listado = unserialize($_SESSION['listadoUsuariosB']);
                                                    foreach ($listado as $usu) {
                                                        // Obtenemos datos de tipo usuario de un usuario en específico
                                                        $tipoUsuario = $tiposUsuarioModel->getTipoUsuario($usu->getID_TIPO_USU());
                                                        $estado = $usuariosModel->obtenerEstadoUsuario($usu->getID_USU());
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $usu->getID_USU(); ?></td>
                                                            <td><?php echo $tipoUsuario->getNOMBRE_TIPO_USU(); ?></td>
                                                            <td><?php echo $usu->getCEDULA_RUC_PASS_USU(); ?></td>
                                                            <td><?php echo $usu->getNOMBRES_USU(); ?></td>
                                                            <td><?php echo $usu->getAPELLIDOS_USU(); ?></td>
                                                            <td><?php echo $usu->getFECH_NAC_USU(); ?></td>
                                                            <td><?php echo $usu->getCIUDAD_NAC_USU(); ?></td>
                                                            <td><?php echo $usu->getDIRECCION_USU(); ?></td>
                                                            <td><?php echo $usu->getFONO_USU(); ?></td>
                                                            <td><?php echo $usu->getE_MAIL_USU(); ?></td>
                                                            <th><?php echo $estado; ?></th>


                                                    <input type="hidden" value="<?php echo $usu->getID_USU(); ?>" id="ID_USU<?php echo $usu->getID_USU(); ?>">
                                                    <input type="hidden" value="<?php echo $usu->getID_TIPO_USU(); ?> " id="ID_TIPO_USU<?php echo $usu->getID_USU(); ?>" >
                                                    <input type="hidden" value="<?php echo $usu->getCEDULA_RUC_PASS_USU(); ?>" id="CEDULA_USU<?php echo $usu->getID_USU(); ?>">
                                                    <input type="hidden" value="<?php echo $usu->getNOMBRES_USU(); ?>" id="NOMBRES_USU<?php echo $usu->getID_USU(); ?>">
                                                    <input type="hidden" value="<?php echo $usu->getAPELLIDOS_USU(); ?>" id="APELLIDOS_USU<?php echo $usu->getID_USU(); ?>">
                                                    <input type="hidden" value="<?php echo $usu->getFECH_NAC_USU(); ?>" id="FECH_NAC_USU<?php echo $usu->getID_USU(); ?>">
                                                    <input type="hidden" value="<?php echo $usu->getCIUDAD_NAC_USU(); ?>" id="CIUDAD_NAC_USU<?php echo $usu->getID_USU(); ?>">
                                                    <input type="hidden" value="<?php echo $usu->getDIRECCION_USU(); ?>" id="DIRECCION_USU<?php echo $usu->getID_USU(); ?>">
                                                    <input type="hidden" value="<?php echo $usu->getFONO_USU(); ?>" id="FONO_USU<?php echo $usu->getID_USU(); ?>">
                                                    <input type="hidden" value="<?php echo $usu->getE_MAIL_USU(); ?>" id="E_MAIL_USU<?php echo $usu->getID_USU(); ?>">
                                                    <input type="hidden" value="<?php echo $usu->getESTADO_USU(); ?>" id="ESTADO_USU<?php echo $usu->getID_USU(); ?>">
                                                    <input type="hidden" value="<?php echo $usu->getCLAVE_USU(); ?>" id="CLAVE_USU<?php echo $usu->getID_USU(); ?>">

                                                    <?php
                                                    echo "</tr>";
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
        <?php
    } else {
        header('Location: ../login.php');
    }
    ?>
</html>