<?php

require_once '../model/UsuariosModel.php';
require_once '../model/AjustesModel.php';
require_once '../Model/ProductosModel.php';

session_start();
$usuariosModel = new UsuariosModel();
$ajustesModel = new AjustesModel();
$productoModel = new ProductosModel();

// Recibimos la opcion desde la vista:
// 
$opcion1 = $_REQUEST['opcion1'];
$opcion2 = $_REQUEST['opcion2'];

unset($_SESSION['ErrorStock']);
unset($_SESSION['producto']);
unset($_SESSION['ErrorBaseDatos']);
unset($_SESSION['ErrorInicioSesion']);
unset($_SESSION['E-MAIL_USU']);
unset($_SESSION['ErrorDetalleAjuste']);

switch ($opcion1) {
    // I N I C I O   D E   S E S I O N
    case "iniciar_sesion":
        $E_MAIL_USU = $_REQUEST['email'];
        $CLAVE_USU = $_REQUEST['password'];

        // Verificamos si el usuario existe
        $usuario = $usuariosModel->getUsuarioInicioSesion($E_MAIL_USU);

        // Verificamos si el email del usuario es diferente a vacio es decir que existe
        if (!empty($usuario->getE_MAIL_USU())) {
            // Verificamos si la contraseña del usuario es correcta
            if ($usuario->getCLAVE_USU() == $CLAVE_USU) {
                $_SESSION['NOMBRE_USUARIO'] = $usuario->getNOMBRES_USU();
                $_SESSION['TIPO_USUARIO'] = $usuariosModel->obtenerTipoUsuario($usuario->getID_TIPO_USU());
                $_SESSION['USUARIO_ACTIVO'] = serialize($usuario);
                header('Location: ../View/Usuario/inicioUsuarios.php');
            } else {
                $_SESSION['ErrorInicioSesion'] = "Contraseña incorrecta";
                $_SESSION['E_MAIL_USU'] = $usuario->getE_MAIL_USU();
                header('Location: ../View/login.php');
            }
        } else {
            unset($_SESSION['E-MAIL_USU']);
            $_SESSION['ErrorInicioSesion'] = "Usuario incorrecto";
            header('Location: ../View/login.php');
        }
        break;
//erika   implementamos el cerrar sesion 
    case"cerrar_sesion":
        session_destroy();
        header('Location: ../View/login.php');
        break;
    // U S U A R I O 
    case "usuario":
        switch ($opcion2) {

            case "listarBodegueros":
                // Obtenemos el array que contiene el listado de Usuarios
                $listadoUsuariosB = $usuariosModel->getUsuariosBodegueros();

                // Guardamos los datos en una variable de sesion serializada
                $_SESSION['listadoUsuariosB'] = serialize($listadoUsuariosB);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Reportes/ReporteBodegueros.php');
                break;

            case "listar":
                // Obtenemos el array que contiene el listado de Usuarios
                $listadoUsuarios = $usuariosModel->getUsuarios();

                // Guardamos los datos en una variable de sesion serializada
                $_SESSION['listadoUsuarios'] = serialize($listadoUsuarios);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Usuario/inicioUsuarios.php');
                break;

            case "insertar_usuarios":
                // Obtenemos parámetros enviados desde formulario de creación de Usuario
                $ID_USU = $_REQUEST['ID_USU'];
                $ID_TIPO_USU = $_REQUEST['ID_TIPO_USU'];
                $CEDULA_RUC_PASS_USU = $_REQUEST['CEDULA_RUC_PASS_USU'];
                $NOMBRES_USU = $_REQUEST['NOMBRES_USU'];
                $APELLIDOS_USU = $_REQUEST['APELLIDOS_USU'];
                $FECH_NAC_USU = $_REQUEST['FECH_NAC_USU'];
                $CIUDAD_NAC_USU = $_REQUEST['CIUDAD_NAC_USU'];
                $DIRECCION_USU = $_REQUEST['DIRECCION_USU'];
                $FONO_USU = $_REQUEST['FONO_USU'];
                $E_MAIL_USU = $_REQUEST['E_MAIL_USU'];
                $ESTADO_USU = $_REQUEST['ESTADO_USU'];
                $CLAVE_USU = $_REQUEST['CLAVE_USU'];

                if ($ID_TIPO_USU == "NULL") {
                    $ID_TIPO_USU = NULL;
                }

                // Enviamos parámetros a método de ingresar Usuario
                try {
                    $usuariosModel->insertarUsuario($ID_USU, $ID_TIPO_USU, $CEDULA_RUC_PASS_USU, $NOMBRES_USU, $APELLIDOS_USU, $FECH_NAC_USU, $CIUDAD_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU, $CLAVE_USU);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }

                // Actualizamos y volvemos a serializar en variable de sesión la lista de Usuarios
                $listadoUsuarios = $usuariosModel->getUsuarios();
                $_SESSION['listadoUsuarios'] = serialize($listadoUsuarios);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Usuario/inicioUsuarios.php');
                break;

            case "eliminar_usuarios":
                // Obtenemos Id del Usuario a eliminar desde formulario
                $ID_USU = $_REQUEST['ID_USU'];

                // Eliminamos Usuario con método eliminarUsuario
                $usuariosModel->eliminarUsuario($ID_USU);

                // Actualizamos y volvemos a serializar en variable de sesión la lista de Usuarios
                $listadoUsuarios = $usuariosModel->getUsuarios();
                $_SESSION['listadoUsuarios'] = serialize($listadoUsuarios);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Usuario/inicioUsuarios.php');
                break;


            case "guardar_usuario":
                //obtenemos los parametros del formulario
                $ID_USU = $_REQUEST['mod_id'];
                $ID_TIPO_USU = $_REQUEST['mod_tipo_usu'];
                $CEDULA_RUC_PASS_USU = $_REQUEST['mod_cedula'];
                $NOMBRES_USU = $_REQUEST['mod_nombre'];
                $APELLIDOS_USU = $_REQUEST['mod_apellido'];
                $FECH_NAC_USU = $_REQUEST['mod_fecha'];
                $CIUDAD_NAC_USU = $_REQUEST['mod_ciudad'];
                $DIRECCION_USU = $_REQUEST['mod_direccion'];
                $FONO_USU = $_REQUEST['mod_telefono'];
                $E_MAIL_USU = $_REQUEST['mod_email'];
                $ESTADO_USU = $_REQUEST['mod_estado'];
                $CLAVE_USU = $_REQUEST['mod_clave'];

                //actualizamos la información del Usuario
                try {
                    $usuariosModel->actualizarUsuario($ID_USU, $ID_TIPO_USU, $CEDULA_RUC_PASS_USU, $NOMBRES_USU, $APELLIDOS_USU, $FECH_NAC_USU, $CIUDAD_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU, $CLAVE_USU);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }

                // Actualizamos y volvemos a serializar en variable de sesión la lista de Usuarios
                $listadoUsuarios = $usuariosModel->getUsuarios();
                $_SESSION['listadoUsuarios'] = serialize($listadoUsuarios);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Usuario/inicioUsuarios.php');
                break;

            default:
                header('Location: ../View/Usuario/inicioUsuarios.php');
                break;
        }
        break;

    // A J U S T E S
    case "ajuste":
        switch ($opcion2) {

            case "listar_detalles_ajustes":
                $ID_PROD = $_REQUEST['ID_PROD'];
                $FECHA_IN = $_REQUEST['FECHA_IN'];
                $FECHA_FIN = $_REQUEST['FECHA_FIN'];
                $listadoDetalles = $ajustesModel->getDetAjusProducto($ID_PROD, $FECHA_IN, $FECHA_FIN);
                $tipoMov = null;
                echo "<thead>
                <tr>
                <th>CÓDIGO AJUSTE</th>
                <th>CÓDIGO DETALLE</th>
                <th>USUARIO</th>
                <th>CANTIDAD</th>
                <th>TIPO MOVIMIENTO</th>
                </thead>";
                foreach ($listadoDetalles as $rep) {

                    if ($rep->getTIPOMOV_DETAJUSTE_PROD() == "I") {
                        $tipoMov = "INGRESO";
                    } else {
                        $tipoMov = "SALIDA";
                    }

                    echo "<tbody>
                <tr class = 'info'>
                <td>" . $rep->getID_AJUSTE_PROD() . "</td>
                <td>" . $rep->getID_DETALLE_AJUSTE_PROD() . "</td>
                <td>" . $rep->getNOMAPE_USU() . "</td>
                <td>" . $rep->getCAMBIO_STOCK_PROD() . "</td>
                <td>" . $tipoMov . "</td>
                </tr>
                </tbody>";
                }
                break;

            case "listar_detalles_fact_venta":
                $ID_PROD = $_REQUEST['ID_PROD'];
                $FECHA_IN = $_REQUEST['FECHA_IN'];
                $FECHA_FIN = $_REQUEST['FECHA_FIN'];
                $listadoDetalles = $ajustesModel->getDetFacVenta($ID_PROD, $FECHA_IN, $FECHA_FIN);
                $tipoMov = null;
                echo "<thead>
                <tr>
                <th>CANTIDAD</th>
                <th>CÓDIGO FACTURA</th>
                <th>CÓDIGO DETALLE</th>
                <th>DESCRIPCIÓN</th>
                <th>VALOR UNIT.</th>
                <th>VALOR TOT.</th>
                </thead>";
                foreach ($listadoDetalles as $rep) {

                    echo "<tbody>
                <tr class = 'info'>
                <td>" . $rep->getCANTIDAD_DET_FAC_VENTA() . "</td>
                <td>" . $rep->getID_CAB_FAC_VENTA() . "</td>
                <td>" . $rep->getID_DET_FAC_VENTA() . "</td>
                <td>" . $rep->getDESCRIPCION_PROD() . "</td>
                <td>" . $rep->getPVPUNIT_DET_FAC_VENTA() . "</td>
                <td>" . $rep->getPVPTOT_DET_FAC_VENTA() . "</td>
                </tr>
                </tbody>";
                }
                break;

            case "listar_detalles_fact_compra":
                $ID_PROD = $_REQUEST['ID_PROD'];
                $FECHA_IN = $_REQUEST['FECHA_IN'];
                $FECHA_FIN = $_REQUEST['FECHA_FIN'];
                $listadoDetalles = $ajustesModel->getDetFacCompra($ID_PROD, $FECHA_IN, $FECHA_FIN);
                $tipoMov = null;
                echo "<thead>
                <tr>
                <th>CANTIDAD</th>
                <th>COÓDIGO FACTURA</th>
                <th>CÓDIGO DETALLE</th>
                <th>DESCRIPCIÓN</th>
                <th>VALOR UNIT.</th>
                <th>VALOR TOT.</th>
                </thead>";
                foreach ($listadoDetalles as $rep) {

                    echo "<tbody>
                <tr class = 'info'>
                <td>" . $rep->getCANTIDAD_DET_FAC_COMPRA() . "</td>
                <td>" . $rep->getID_CAB_FAC_COMPRA() . "</td>
                <td>" . $rep->getID_DET_FAC_COMPRA() . "</td>
                <td>" . $rep->getDESCRIPCION_PROD() . "</td>
                <td>" . $rep->getPVPUNIT_DET_FAC_COMPRA() . "</td>
                <td>" . $rep->getPVPTOT_DET_FAC_COMPRA() . "</td>
                </tr>
                </tbody>";
                }
                break;

            case "obtener_titulo":
                $ID_PROD = $_REQUEST['ID_PROD'];
                $producto = $productoModel->getProducto($ID_PROD);
                echo '<span class="glyphicon glyphicon-list-alt"></span> Reportes de Movimientos de "' . $producto->getNOMBRE_PROD() . '"';
                break;

            case "listar_ajustes":
                $listadoAjustes = $ajustesModel->getCabAjustes();
                $_SESSION['listadoAjustes'] = serialize($listadoAjustes);
                header('Location: ../View/Ajustes/inicioAjuste.php');
                break;

            case "insertar_ajuste":
                $ID_AJUSTE_PROD = $_REQUEST['ID_AJUSTE_PROD'];
                $MOTIVO_AJUSTE_PROD = $_REQUEST['MOTIVO_AJUSTE_PROD'];
                try {
                    $ajustesModel->insertarCabAjuste($ID_AJUSTE_PROD, $MOTIVO_AJUSTE_PROD);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }

                $listadoAjustes = $ajustesModel->getCabAjustes();
                $_SESSION['listadoAjustes'] = serialize($listadoAjustes);

                header('Location: ../View/Ajustes/inicioAjuste.php');
                break;

            case "eliminar_ajuste":
                $ID_AJUSTE_PROD = $_REQUEST['ID_AJUSTE_PROD'];
                $ajustesModel->eliminarCabAjuste($ID_AJUSTE_PROD);
                $listadoAjustes = $ajustesModel->getCabAjustes();
                $_SESSION['listadoAjustes'] = serialize($listadoAjustes);
                header('Location: ../View/Ajustes/inicioAjuste.php');
                break;

            case "editar_ajuste":
                $ID_AJUSTE_PROD = $_REQUEST['ID_AJUSTE_PROD'];
                $ajusteCab = $ajustesModel->getCabAjuste($ID_AJUSTE_PROD);
                $listaAjusteDet = $ajustesModel->getDetallesAjuste($ID_AJUSTE_PROD);
                $_SESSION['listaAjusteDet'] = serialize($listaAjusteDet);
                $_SESSION['ajusteCab'] = serialize($ajusteCab);
                header('Location: ../View/Ajustes/editarAjuste.php');
                break;

            case "guardar_ajuste":
                $ID_AJUSTE_PROD = $_REQUEST['mod_id'];
                $MOTIVO_AJUSTE_PROD = $_REQUEST['mod_motivo'];
                $FECHA_AJUSTE_PROD = $_REQUEST['mod_fecha'];
                try {
                    $ajustesModel->actualizarCabAjuste($ID_AJUSTE_PROD, $MOTIVO_AJUSTE_PROD, $FECHA_AJUSTE_PROD);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }
                $listadoAjustes = $ajustesModel->getCabAjustes();
                $_SESSION['listadoAjustes'] = serialize($listadoAjustes);
                header('Location: ../View/Ajustes/inicioAjuste.php');
                break;

            case "imprimir_ajuste":
                $cod = $_REQUEST['ID_AJUSTE_PROD'];
                $mot = $_REQUEST['MOTIVO_AJUSTE_PROD'];
                // erika INSERTAMOS EL AJUSTE MODEL   $ajustesModel->actualizarImpAjuste($cod);
                $ajustesModel->actualizarImpAjuste($cod);
                $listadoDetAjuste = $ajustesModel->getDetAjustes($cod);
                $_SESSION['listadoDetAjuste'] = serialize($listadoDetAjuste);
                $_SESSION['cod'] = $cod;
                $_SESSION['mot'] = $mot;

                header('Location: ../ExportarPDF/pdf_exportar.php');
                break;

            case "nuevo_ajuste":
                unset($_SESSION['listadoAjustes']);
                $_SESSION['ID_AJUSTE_PROD'] = $ajustesModel->generarCodigoAjuste();
                unset($_SESSION['listaAjusteDet']);
                header('Location: ../View/Ajustes/nuevoAjuste.php');
                break;

            case "cancelar_ajuste":
                unset($_SESSION['listaAjusteDet']);
                unset($_SESSION['listaDetPorEliminar']);
                header('Location: ../View/Ajustes/inicioAjuste.php');
                break;

            case "insertar_detalle_ajuste":
                //obtenemos los parametros del formulario:
                $ID_PROD = $_REQUEST['ID_PROD'];
                $cantidad = $_REQUEST['cantidad'];
                $tipoMovimiento = $_REQUEST['optradio'];
                $ID_USU = $_REQUEST['ID_USU'];
                $aux = $_REQUEST['aux'];

                $prod = $productoModel->getProducto($ID_PROD); //OBtenemos el producto

                if (!isset($_SESSION['listaAjusteDet'])) {
                    $listaAjusteDet = array();
                } else {
                    $listaAjusteDet = unserialize($_SESSION['listaAjusteDet']);
                }
                try {
                    //-------------------------------
                    if ($cantidad > $prod->getSTOCK_PROD() && $tipoMovimiento != "I") {
                        $_SESSION['ErrorStock'] = "Error: La cantidad ingresada es mayor al stock actual del producto";
                    } else {
                        if ($cantidad == 0) {
                            $_SESSION['ErrorStock'] = "Error: La cantidad debe ser mayor a cero";
                        } else {
                            $listaAjusteDet = $ajustesModel->adicionarDetalle($listaAjusteDet, $ID_PROD, $ID_USU, $tipoMovimiento, $cantidad);
                            $_SESSION['listaAjusteDet'] = serialize($listaAjusteDet);
                        }
                    }
                    //-------------------------------                    
                } catch (Exception $e) {
                    $ErrorDetalleAjuste = $e->getMessage();
                    $_SESSION['ErrorDetalleAjuste'] = $ErrorDetalleAjuste;
                }

                if ($aux == "nuevo") {
                    header('Location: ../View/Ajustes/nuevoAjuste.php#detalles_ajuste');
                } else {
                    header('Location: ../View/Ajustes/editarAjuste.php#detalles_ajuste');
                }
                break;

            case "eliminar_detalle":
                //obtenemos los parametros del formulario:
                $ID_DETALLE_AJUSTE_PROD = $_REQUEST['ID_DETALLE_AJUSTE_PROD'];
                $aux = $_REQUEST['aux'];

                $listaAjusteDet = unserialize($_SESSION['listaAjusteDet']);
                $listaAjusteDet = $ajustesModel->eliminarDetalle($listaAjusteDet, $ID_DETALLE_AJUSTE_PROD);

                if ($aux == "nuevo") {
                    $_SESSION['listaAjusteDet'] = serialize($listaAjusteDet);
                    header('Location: ../View/Ajustes/nuevoAjuste.php');
                } else {
                    if (!isset($_SESSION['listaDetPorEliminar'])) {
                        $listaDetPorEliminar = array();
                        array_push($listaDetPorEliminar, $ID_DETALLE_AJUSTE_PROD);
                        $_SESSION['listaDetPorEliminar'] = serialize($listaDetPorEliminar);
                    } else {
                        $listaDetPorEliminar = unserialize($_SESSION['listaDetPorEliminar']);
                        array_push($listaDetPorEliminar, $ID_DETALLE_AJUSTE_PROD);
                        $_SESSION['listaDetPorEliminar'] = serialize($listaDetPorEliminar);
                    }
                    $_SESSION['listaAjusteDet'] = serialize($listaAjusteDet);
                    header('Location: ../View/Ajustes/editarAjuste.php');
                }

                break;

            case "insertar_ajuste_detalles":
                //obtenemos los parametros del formulario:
                $ID_AJUSTE_PROD = $_REQUEST['ID_AJUSTE_PROD'];
                $MOTIVO_AJUSTE_PROD = $_REQUEST['MOTIVO_AJUSTE_PROD'];

                if (isset($_SESSION['listaAjusteDet'])) {
                    $listaAjusteDet = unserialize($_SESSION['listaAjusteDet']);
                    try {
                        $ajustesModel->insertarAjusteDetalles($listaAjusteDet, $ID_AJUSTE_PROD, $MOTIVO_AJUSTE_PROD);
                        unset($_SESSION['listaAjusteDet']);
                        $listadoAjustes = $ajustesModel->getCabAjustes();
                        $_SESSION['listadoAjustes'] = serialize($listadoAjustes);
                    } catch (Exception $e) {
                        $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                    }
                    header('Location: ../View/Ajustes/inicioAjuste.php');
                } else {
                    $_SESSION['ErrorDetalleAjuste'] = "Debe registrar por lo menos un detalle de Ajuste antes de guardar";
                    header('Location: ../View/Ajustes/nuevoAjuste.php');
                }

                break;

            case "guardar_ajuste_detalles":
                //obtenemos los parametros del formulario:
                $ID_AJUSTE_PROD = $_REQUEST['ID_AJUSTE_PROD'];
                $MOTIVO_AJUSTE_PROD = $_REQUEST['MOTIVO_AJUSTE_PROD'];

                if (isset($_SESSION['listaAjusteDet'])) {
                    $listaAjusteDet = unserialize($_SESSION['listaAjusteDet']);
                    $listaDetPorEliminar = unserialize($_SESSION['listaDetPorEliminar']);
                    try {
                        $ajustesModel->actualizarAjusteDetalles($listaAjusteDet, $listaDetPorEliminar, $ID_AJUSTE_PROD, $MOTIVO_AJUSTE_PROD);
                        unset($_SESSION['listaAjusteDet']);
                        unset($_SESSION['listaDetPorEliminar']);
                        $listadoAjustes = $ajustesModel->getCabAjustes();
                        $_SESSION['listadoAjustes'] = serialize($listadoAjustes);
                        header('Location: ../View/Ajustes/inicioAjuste.php');
                    } catch (Exception $e) {
                        $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                    }
                } else {
                    $_SESSION['ErrorDetalleAjuste'] = "Debe registrar por lo menos un detalle de Ajuste antes de guardar";
                    header('Location: ../View/Ajustes/editarAjuste.php');
                }

                break;

            case "recargarDatosProducto":
                $ID_PROD = $_REQUEST['ID_PROD'];
                $producto = $productoModel->getProducto($ID_PROD);
                $estadoProd = null;
                if ($producto->getGRAVA_IVA_PROD() == "S") {
                    $estadoProd = "SI";
                } else {
                    $estadoProd = "NO";
                }
                echo "<thead>
                <tr>
                <th width='40%'>PRODUCTO</th>
                <th width='20%'>PRECIO</th>
                <th width='20%'>GRAVA IVA</th>
                <th>STOCK</th>
                </thead>
                <tbody>
                <tr class = 'info'>
                <td>" . $producto->getNOMBRE_PROD() . "</td>
                <td>" . $producto->getPVP_PROD() . "</td>
                <td>" . $estadoProd . "</td>
                <td>" . $producto->getSTOCK_PROD() . "</td>
                </tr>
                </tbody>";
                break;

            case "recargarDatosProductoBusquedaInteligente":
                unset($_SESSION['ErrorStock']);
                $ID_PROD = $_REQUEST['ID_PROD'];
                $producto = $productoModel->getProducto($ID_PROD);
                $_SESSION['producto'] = serialize($producto);
                header('Location: ../View/Ajustes/nuevoAjuste.php');
//                $estadoProd = null;
//                if ($producto->getGRAVA_IVA_PROD() == "S") {
//                    $estadoProd = "SI";
//                } else {
//                    $estadoProd = "NO";
//                }             
//                echo "<thead>
//                <tr>
//                <th width='40%'>PRODUCTO</th>
//                <th width='20%'>PRECIO</th>
//                <th width='20%'>GRAVA IVA</th>
//                <th>STOCK</th>
//                </thead>
//                <tbody>
//                <tr class = 'info'>
//                <td>" . $producto->getNOMBRE_PROD() . "</td>
//                <td>" . $producto->getPVP_PROD() . "</td>
//                <td>" . $estadoProd . "</td>
//                <td>" . $producto->getSTOCK_PROD() . "</td>
//                </tr>
//                </tbody>";  
                break;
        }
        break;

    // P R O D U C T O S
    case "producto":
        switch ($opcion2) {
            case "listar_productos":
                // Obtenemos el array que contiene el listado de Usuarios
                $listadoProductos = $productoModel->getProductos();

                // Guardamos los datos en una variable de sesion serializada
                $_SESSION['listadoProductos'] = serialize($listadoProductos);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Producto/inicioProductos.php');
                break;

            case "insertar_producto":
                // Obtenemos parámetros enviados desde formulario de creación de producto
                $ID_PROD = $_REQUEST['ID_PROD'];
                $NOMBRE_PROD = $_REQUEST['NOMBRE_PROD'];
                $DESCRIPCION_PROD = $_REQUEST['DESCRIPCION_PROD'];
                $GRABA_IVA_PROD = $_REQUEST['GRABA_IVA_PROD'];
                $COSTO_PROD = $_REQUEST['COSTO_PROD'];
                $PVP_PROD = $_REQUEST['PVP_PROD'];
                $ESTADO_PROD = $_REQUEST['ESTADO_PROD'];
                $STOCK_PROD = $_REQUEST['STOCK_PROD'];


                // Enviamos parámetros a método de ingresar producto
                try {
                    $productoModel->insertarProducto($ID_PROD, $NOMBRE_PROD, $DESCRIPCION_PROD, $GRABA_IVA_PROD, $COSTO_PROD, $PVP_PROD, $ESTADO_PROD, $STOCK_PROD);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }
                // Actualizamos y volvemos a serializar en variable de sesión la lista de Usuarios
                $listadoProductos = $productoModel->getProductos();
                $_SESSION['listadoProductos'] = serialize($listadoProductos);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Producto/inicioProductos.php');
                break;

            case "eliminar_producto":
                // Obtenemos Id del Usuario a eliminar desde formulario
                $ID_PROD = $_REQUEST['ID_PROD'];

                // Eliminamos Usuario con método eliminarUsuario
                $productoModel->eliminarProducto($ID_PROD);

                // Actualizamos y volvemos a serializar en variable de sesión la lista de Usuarios
                $listadoProductos = $productoModel->getProductos();
                $_SESSION['listadoProductos'] = serialize($listadoProductos);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Producto/inicioProductos.php');
                break;

//            case "editar_producto":
//                // Obtenemos Id del Usuario a editar desde formulario
//                $ID_PROD = $_REQUEST['ID_PROD'];
//
//                // Buscamos y obtenemos información del Producto
//                $producto = $productoModel->getProducto($ID_PROD);
//
//                // Guardamos datos del usuario en variable de sesión serializada
//                $_SESSION['producto'] = serialize($producto);
//
//                // Redireccionamos a vista para editar información
//                header('Location: ../View/Producto/editarProducto.php');
//                break;

            case "actualizar_productos":
                //obtenemos los parametros del formulario
                $ID_PROD = $_REQUEST['mod_id_pro1'];
                $NOMBRE_PROD = $_REQUEST['mod_nombre'];
                $DESCRIPCION_PROD = $_REQUEST['mod_descripcion'];
                $GRABA_IVA_PROD = $_REQUEST['mod_Iva'];
                $COSTO_PROD = $_REQUEST['mod_costo'];
                $PVP_PROD = $_REQUEST['mod_pvp'];
                $ESTADO_PROD = $_REQUEST['mod_estado'];
                $STOCK_PROD = $_REQUEST['mod_stock'];

                //actualizamos la información del producto
                try {
                    $productoModel->actualizarProducto($ID_PROD, $NOMBRE_PROD, $DESCRIPCION_PROD, $GRABA_IVA_PROD, $COSTO_PROD, $PVP_PROD, $ESTADO_PROD, $STOCK_PROD);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }

                // Actualizamos y volvemos a serializar en variable de sesión la lista de Producto
                $listadoProductos = $productoModel->getProductos();
                $_SESSION['listadoProductos'] = serialize($listadoProductos);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Producto/inicioProductos.php');
                break;

            default:
                header('Location: ../View/Producto/inicioProductos.php');
                break;
        }
        break;


    default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina principal:
        header('Location: ../View/login.php');
        break;
}