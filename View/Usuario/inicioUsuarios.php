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
            <title>Usuarios</title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				

            <script src="../../Bootstrap/js/jquery-2.1.4.js"></script>
            <script src="../../Bootstrap/js/bootstrap.js"></script>
            <script src="../../Bootstrap/js/getDatos.js"></script>
            <script src="../../Bootstrap/js/bootstrap-table.js"></script>
            <link href="../../Bootstrap/css/bootstrap-table.css" rel="stylesheet">
            <script src="../../Bootstrap/js/validaciones.js"></script>
            <link href="../../Bootstrap/css/bootstrap.css" rel="stylesheet" />
            <link rel="../../stylesheet" href="Bootstrap/css/bootstrap-theme.css">

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
                function confirEliminar()
                {
                    swal agree = confirm("Esta seguro que desea eliminar el usuario?");
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
                                    <li><a href="../../Controller/controller.php?opcion1=cerrar_sesion"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión </a></li>
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
                            <h1><span class="glyphicon glyphicon-user"></span> USUARIOS</h1></div>
                    </div>
                </div>

                <!--La clase col nos permite que la pagina sea responsive mediante numero de columnas
                     donde el total de columnas es 12 y
                     donde lg es en tamaño de escritorio, md medianos, sm tablets, xs celulares -->

                <div class="row">
                    <div class="col-md-12" style="padding-top: 5px">
                        <!--La class nav nav-pills nos permite hacer menús-->
                        <ul class="nav nav-pills">
                            <li role="presentation"><a href="../../Controller/controller.php?opcion1=usuario&opcion2=listar"><h4>MOSTRAR TODOS</h4></a></li>
                            <?php
                            // Verificamos si es Administrador habilitamos la funcion de crear usuarios
                            if ($usuarioSesion->getID_TIPO_USU() == "TUSU-0001") {
                                echo "<li role = 'presentation'><a href = '#nuevoUSU' data-toggle = 'modal'><h4>NUEVO USUARIO</h4></a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <br>

                <?php
                if (isset($_SESSION['ErrorBaseDatos'])) {
                    echo "<div class='alert alert-danger'>Usuario Duplicado. La Cédula, RUC o Pasaporte ya existe en la Base de Datos</div>";
                }
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><h4>Lista de Usuarios</h4></div>
                            <div class="panel-body">
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
                                                    <th>ACCIONES</th>
                                                    <th>ID USUARIO</th>
                                                    <th>TIPO USUARIO</th>
                                                    <th>CÉDULA - RUC</th>
                                                    <th>NOMBRES</th>
                                                    <th>APELLIDOS</th>
                                                    <th>FECHA NACIMIENTO</th>
                                                    <th>CIUDAD NACIMIENTO</th>
                                                    <th>DIRECCIÓN</th>
                                                    <th>TELÉFONO</th>
                                                    <th>E-MAIL</th>
                                                    <th>ESTADO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Verificamos si existe la variable de sesión que contiene la lista de Usuarios
                                                if (isset($_SESSION['listadoUsuarios'])) {
                                                    // Deserializamos y mostraremos los atributos de los usuarios usando un ciclo for
                                                    $listado = unserialize($_SESSION['listadoUsuarios']);
                                                    foreach ($listado as $usu) {
                                                        // Obtenemos datos de tipo usuario de un usuario en específico
                                                        $tipoUsuario = $tiposUsuarioModel->getTipoUsuario($usu->getID_TIPO_USU());
                                                        $estado = $usuariosModel->obtenerEstadoUsuario($usu->getID_USU());
                                                        ?>
                                                        <tr>
                                                            <?php
                                                            // Un bodeguero solo puede editar datos de los que no tienen perfil
                                                            if ($usuarioSesion->getID_TIPO_USU() == "TUSU-0001") {
                                                                ?>
                                                                <td><a href = "#editUSU" onclick = "obtener_datos_usuario('<?php echo $usu->getID_USU(); ?>')" data-toggle = "modal"><span class = "glyphicon glyphicon-pencil">Editar</span></a></td>
                                                                <?php
                                                            } else {
                                                                if (is_null($usu->getID_TIPO_USU())) {
                                                                    ?>
                                                                    <td><a href = "#editUSU" onclick = "obtener_datos_usuario('<?php echo $usu->getID_USU(); ?>')" data-toggle = "modal"><span class = "glyphicon glyphicon-pencil">Editar</span></a></td>
                                                                    <?php
                                                                } else {
                                                                    echo "<td></td>";
                                                                }
                                                            }
                                                            ?>

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
                                                            <td><?php echo $estado; ?></td>


                                                    <input type="hidden" value="<?php echo $usu->getID_USU(); ?>" id="ID_USU<?php echo $usu->getID_USU(); ?>">
                                                    <input type="hidden" value="<?php echo $usu->getID_TIPO_USU(); ?> " id="TIPO_USU<?php echo $usu->getID_TIPO_USU(); ?>" >
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

                <!--Ventana emergente para Nuevo Usuario-->
                <div class="modal fade" id="nuevoUSU">
                    <div class="modal-dialog">
                        <form class="form-horizontal" action="../../Controller/controller.php">
                            <input type="hidden" name="opcion1" value="usuario">
                            <input type="hidden" name="opcion2" value="insertar_usuarios">

                            <div class="modal-content">
                                <!-- Header de la ventana -->

                                <div class="modal-header bg-success">
                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title"><span class="glyphicon glyphicon-user"></span> Nuevo Usuario </h3>
                                </div>

                                <!-- Contenido de la ventana -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Id Usuario </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <?php echo $usuariosModel->generarUsuario(); ?>
                                                    <input type="hidden" name="ID_USU" value="<?php echo $usuariosModel->generarUsuario() ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Tipo Usuario </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-control" id="ID_TIPO_USU" name="ID_TIPO_USU">
                                                        <option value="NULL" selected>(Sin Especificar)</option>
                                                        <?php
                                                        $listado = $tiposUsuarioModel->getTiposUsuario();
                                                        foreach ($listado as $tipoUsuario) {
                                                            ?>
                                                            <option  value="<?php echo $tipoUsuario->getID_TIPO_USU(); ?>"><?php echo $tipoUsuario->getNOMBRE_TIPO_USU(); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Identificación </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select id="ID_TIPO" name="ID_TIPO">
                                                        <option value="1">CÉDULA</option>
                                                        <option value="2">RUC</option>
                                                        <!--                                                        <option value="3">PASAPORTE</option>-->
                                                    </select>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" maxlength="13" minlength="10" class="form-control" name="CEDULA_RUC_PASS_USU"  placeholder="Ingrese su N° de Cédula - Ruc - Pasaporte" onchange="ValId(this.form.CEDULA_RUC_PASS_USU.value, this.form.boton)" required />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Nombres </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloLetras(event);" type="text" class="form-control" name="NOMBRES_USU" placeholder="Ingrese sus Nombres" required pattern="|^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$|" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Apellidos </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloLetras(event);" type="text" class="form-control" name="APELLIDOS_USU" placeholder="Ingrese sus Apellidos" required="true" required pattern="|^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$|"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Fecha de Nac. </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="date" class="form-control" name="FECH_NAC_USU" min="1900-01-01" max="<?php echo date("Y-m-d") ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Ciudad </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloLetras(event);" type="text" class="form-control" name="CIUDAD_NAC_USU" placeholder="Ingrese la Ciudad de Nacimiento" required="true" required pattern="|^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$|"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Dirección </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="DIRECCION_USU" placeholder="Ingrese su Dirección" required="true" required pattern="|^[a-zA-Z0-9]+(\s*[a-zA-Z0-9]*)*[a-zA-Z0-9]+$|"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Teléfono </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloNumeros(event);" type="text" maxlength="10" class="form-control" name="FONO_USU" placeholder="Ingrese su numero de Teléfono"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> E-mail </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="email" class="form-control" name="E_MAIL_USU" placeholder="Ingrese su Correo"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk" required="true"></span> Estado </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-control" id="ESTADO_USU" name="ESTADO_USU" required="true">
                                                        <option value="A">ACTIVO</option>
                                                        <option value="I">INACTIVO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Clave </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="password" class="form-control" name="CLAVE_USU" placeholder="Ingrese su Clave" required="true"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer de la ventana -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button id="boton" class="btn btn-success">Guardar Usuario</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!--Ventana emergente para Editar Usuario-->
                <div class="modal fade" id="editUSU">
                    <div class="modal-dialog">
                        <form class="form-horizontal" action="../../Controller/controller.php">
                            <input type="hidden" name="opcion1" value="usuario">
                            <input type="hidden" name="opcion2" value="guardar_usuario">

                            <div class="modal-content">
                                <!-- Header de la ventana --> 
                                <div class="modal-header bg-success">
                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title"><span class="glyphicon glyphicon-cog"></span> Editar Usuario</h3>
                                </div>

                                <!-- Contenido de la ventana -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Id Usuario</label>    
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="hidden" id="mod_id" name="mod_id" value=""  >
                                                    <p id="mod_cod"></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Tipo Usuario </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-control" id="mod_tipo_usu" name="mod_tipo_usu">
                                                        <option value="NULL">(Sin Especificar)</option>
                                                        <?php
                                                        $listado = $tiposUsuarioModel->getTiposUsuario();
                                                        if ($usuarioSesion->getID_TIPO_USU() == "TUSU-0001") {
                                                            foreach ($listado as $tipoUsuario) {
                                                                ?>
                                                                <option  value="<?php echo $tipoUsuario->getID_TIPO_USU(); ?>"><?php echo $tipoUsuario->getNOMBRE_TIPO_USU(); ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option  value="TUSU-0002"><?php echo "BODEGUERO" ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <?php
                                            // Solo los Adn¡ministradores pueden editar los siguientes campos
                                            if ($usuarioSesion->getID_TIPO_USU() == "TUSU-0001") {
                                                ?>
                                                <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-1">
                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Identificación </label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input  type="text" readonly="readonly" id="mod_cedula" maxlength="13" minlength="10" class="form-control" name="mod_cedula" required />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-1">
                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Nombres </label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input onkeypress="return SoloLetras(event);"type="text" class="form-control" id="mod_nombre" name="mod_nombre"  required pattern="|^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$|" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-1">
                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Apellidos </label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input onkeypress="return SoloLetras(event);"type="text" class="form-control" id="mod_apellido" name="mod_apellido"  required pattern="|^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$|" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-1">
                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Fecha </label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="date" id="mod_fecha" name="mod_fecha" value="" min="1900-01-01" max="<?php echo date("Y-m-d") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-1">
                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Ciudad </label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input onkeypress="return SoloLetras(event);"type="text" class="form-control" id="mod_ciudad" name="mod_ciudad"  required pattern="|^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$|" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-1">
                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Dirección </label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input onkeypress="return SoloLetras(event)"type="text" class="form-control" id="mod_direccion" name="mod_direccion"  required pattern="|^[a-zA-Z0-9]+(\s*[a-zA-Z0-9]*)*[a-zA-Z0-9]+$|" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-1">
                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Teléfono </label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input onkeypress="return SoloNumeros(event);" type="text" maxlength="10" class="form-control" id="mod_telefono" name="mod_telefono" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-1">
                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> E-mail </label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="email" class="form-control" id="mod_email" name="mod_email" />
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-1">
                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Estado </label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" id="mod_estado" name="mod_estado">
                                                            <option value="A">ACTIVO</option>
                                                            <option value="I">INACTIVO</option>
                                                        </select>
                                                    </div>  
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-1">
                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Clave </label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="password" class="form-control" id="mod_clave" name="mod_clave" minlength="8" required />
                                                    </div>
                                                </div>  
                                                <?php
                                            } else {
                                                ?>
                                                <input onkeypress="return SoloNumeros(event);" type="hidden" id="mod_cedula" name="mod_cedula" />
                                                <input onkeypress="return SoloLetras(event);"type="hidden" id="mod_nombre" name="mod_nombre" />
                                                <input onkeypress="return SoloLetras(event);"type="hidden" id="mod_apellido" name="mod_apellido" />
                                                <input type="hidden" id="mod_fecha" name="mod_fecha">
                                                <input type="hidden" id="mod_id_tipo_usu" name="mod_id_tipo_usu">
                                                <input onkeypress="return SoloLetras(event);"type="hidden" id="mod_ciudad" name="mod_ciudad" />
                                                <input onkeypress="return SoloLetras(event)"type="hidden" id="mod_direccion" name="mod_direccion" />
                                                <input onkeypress="return SoloNumeros(event);" type="hidden" id="mod_telefono" name="mod_telefono" />
                                                <input type="hidden" id="mod_email" name="mod_email" />
                                                <input type="hidden" id="mod_estado" name="mod_estado">
                                                <input type="hidden" id="mod_clave" name="mod_clave" />
                                                <?php
                                            }
                                            ?>
                                        </div>    
                                    </div>
                                    <!-- Footer de la ventana -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" id="boton" class="btn btn-success">Guardar Usuario</button>
                                    </div>
                                </div>
                            </div>
                        </form>    
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