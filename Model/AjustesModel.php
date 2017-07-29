<?php

include_once 'DataBase.php';
include_once 'CabeceraAjuste.php';
include_once 'AjusteDet.php';
include_once 'Producto.php';
include_once 'ProductosModel.php';
include_once 'VistaAjusteDet.php';
include_once 'RepDetAjuProd.php';
include_once 'RepDetFacVenta.php';
include_once 'RepDetFacCompra.php';

class AjustesModel {

// M E T O D O S  D E   C A B E C E R A   D E   A J U S T E
    //METODO PARA OBTENER LA LISTA DE LOS AJUSTES
    public function getCabAjustes() {
        $pdo = Database::connect();
        $sql = 'select * from INV_TAB_AJUSTES_PRODUCTOS order by "ID_AJUSTE_PROD"';
        $resultado = $pdo->query($sql);
        $listadoCabAjustes = array();
        foreach ($resultado as $res) {
           $Cab_ajuste = new CabeceraAjuste($res['ID_AJUSTE_PROD'], $res['MOTIVO_AJUSTE_PROD'], $res['FECHA_AJUSTE_PROD'], $res['FECHA_IMP_AJUSTE_PROD'], $res['ESTADO_IMP_AJUSTE_PROD']);
            array_push($listadoCabAjustes, $Cab_ajuste);
        }
        Database::disconnect();
        return $listadoCabAjustes;
    }

    // METODO PARA OBTENER UN AJUSTE ESPECIFICO POR MEDIO DEL PARAMETRO CODIGO DE AJUSTE
    public function getCabAjuste($ID_AJUSTE_PROD) {
        $pdo = Database::connect();
        $sql = 'select * from INV_TAB_AJUSTES_PRODUCTOS where "ID_AJUSTE_PROD"=?';
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($ID_AJUSTE_PROD));
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $Cab_ajuste = new CabeceraAjuste($res['ID_AJUSTE_PROD'], $res['MOTIVO_AJUSTE_PROD'], $res['FECHA_AJUSTE_PROD'], $res['FECHA_IMP_AJUSTE_PROD'], $res['ESTADO_IMP_AJUSTE_PROD']);
        Database::disconnect();
        return $Cab_ajuste;
    }
    
    
    ////REALIZAR ESTA SONSULTA /////////////
    //Método para obtener la información requerida en reportes de Movimeintos de Detalles de Ajustes de Productos
    public function getDetAjusProducto($ID_PROD,$FECHA_IN,$FECHA_FIN) {
        //Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = "select D.ID_AJUSTE_PROD as 'CODIGO_AJUSTE', D.ID_DETALLE_AJUSTE_PROD as 'CODIGO_DETALLE',
               CONCAT(U.NOMBRES_USU,' ',U.APELLIDOS_USU) as 'USUARIO', D.CAMBIO_STOCK_PROD as 'CANTIDAD',
               D.TIPOMOV_DETAJUSTE_PROD as 'TIPO_MOVIMIENTO'
               FROM inv_tab_detalle_ajuste_prod D INNER JOIN inv_tab_usuarios U
               ON D.ID_USU=U.ID_USU INNER JOIN inv_tab_ajustes_productos A
               ON A.ID_AJUSTE_PROD=D.ID_AJUSTE_PROD
               WHERE D.ID_PROD='".$ID_PROD."' and A.FECHA_AJUSTE_PROD BETWEEN '".$FECHA_IN."' AND '".$FECHA_FIN."'";
        
        $resultado = $pdo->query($sql);
        
        $listadoDetalles = array();
        foreach ($resultado as $res) {
            $repdetajuprod = new RepDetAjuProd($res['CODIGO_AJUSTE'],$res['CODIGO_DETALLE'], $res['USUARIO'], $res['CANTIDAD'], $res['TIPO_MOVIMIENTO']);
            array_push($listadoDetalles, $repdetajuprod);
        }
        
        Database::disconnect();

        // Retornamos el Usuario encontrado
        return $listadoDetalles;
    }
    
    ////REALIZAR ESTA CONSULTA
    
    //Método para obtener la información requerida en reportes de Movimeintos de Detalles de Facturas de Venta de Productos
    public function getDetFacVenta($ID_PROD,$FECHA_IN,$FECHA_FIN) {
        //Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = "SELECT D.CANTIDAD_DET_FAC_VENTA as 'CANTIDAD', D.ID_CAB_FAC_VENTA as 'CODIGO_FACTURA',
                D.ID_DET_FAC_VENTA as 'CODIGO_DETALLE', P.DESCRIPCION_PROD as 'DESCRIPCIÓN',
                D.PVPUNIT_DET_FAC_VENTA as 'VALOR_UNIT.', D.PVPTOT_DET_FAC_VENTA as 'VALOR_TOT.'
                FROM com_tab_detalle_venta_prod D INNER JOIN com_tab_ventas_producto C ON D.ID_CAB_FAC_VENTA=C.ID_CAB_FAC_VENTA
                INNER JOIN inv_tab_productos P ON P.ID_PROD=D.ID_PROD
                WHERE D.ID_PROD='".$ID_PROD."' AND C.FECHA_CAB_FAC_VENTA BETWEEN '".$FECHA_IN."' AND '".$FECHA_FIN."'";
        
        $resultado = $pdo->query($sql);
        
        $listadoDetalles = array();
        foreach ($resultado as $res) {
            $repdetfacventa = new RepDetFacVenta($res['CANTIDAD'],$res['CODIGO_FACTURA'], $res['CODIGO_DETALLE'], $res['DESCRIPCIÓN'], $res['VALOR_UNIT.'], $res['VALOR_TOT.']);
            array_push($listadoDetalles, $repdetfacventa);
        }
        
        Database::disconnect();

        // Retornamos el Usuario encontrado
        return $listadoDetalles;
    }
    // REALIZAR ESTA CONSULTA
    //Método para obtener la información requerida en reportes de Movimientos de Detalles de Facturas de Compra de Productos
    public function getDetFacCompra($ID_PROD,$FECHA_IN,$FECHA_FIN) {
        //Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = "SELECT D.CANTIDAD_DET_FAC_COMPRA as 'CANTIDAD', D.ID_CAB_FAC_COMPRA as 'CODIGO_FACTURA',
                D.ID_DET_FAC_COMPRA as 'CODIGO_DETALLE', P.DESCRIPCION_PROD as 'DESCRIPCIÓN',
                D.PVPUNIT_DET_FAC_COMPRA as 'VALOR_UNIT.', D.PVPTOT_DET_FAC_COMPRA as 'VALOR_TOT.'
                FROM com_tab_detalle_compra_prod D INNER JOIN com_tab_compras_producto C ON D.ID_CAB_FAC_COMPRA=C.ID_CAB_FAC_COMPRA
                INNER JOIN inv_tab_productos P ON P.ID_PROD=D.ID_PROD
                WHERE D.ID_PROD='".$ID_PROD."' AND C.FECHA_CAB_FAC_COMPRA BETWEEN '".$FECHA_IN."' AND '".$FECHA_FIN."'";
        
        $resultado = $pdo->query($sql);
        
        $listadoDetalles = array();
        foreach ($resultado as $res) {
            $repdetfaccompra = new RepDetFacCompra($res['CANTIDAD'],$res['CODIGO_FACTURA'], $res['CODIGO_DETALLE'], $res['DESCRIPCIÓN'], $res['VALOR_UNIT.'], $res['VALOR_TOT.']);
            array_push($listadoDetalles, $repdetfaccompra);
        }
        
        Database::disconnect();

        // Retornamos el Usuario encontrado
        return $listadoDetalles;
    }

    // METODO PARA INSERTAR UN AJUSTE (CABECERA)
    public function insertarCabAjuste($ID_AJUSTE_PROD, $MOTIVO_AJUSTE_PROD) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'insert into INV_TAB_AJUSTES_PRODUCTOS("ID_AJUSTE_PROD","MOTIVO_AJUSTE_PROD") values(?,?)';
        $consulta = $pdo->prepare($sql);
        try {
            $consulta->execute(array($ID_AJUSTE_PROD, $MOTIVO_AJUSTE_PROD));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    // METODO PARA ELIMINAR UN AJUSTE (CABECERA) 
    // //-- AL ELIMINAR ESTA CABECERA SE ELIMINARIAN LOS DETALLES DE AJUSTES DE ESTA CABECERA   
    public function eliminarCabAjuste($ID_AJUSTE_PROD) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'delete from INV_TAB_AJUSTES_PRODUCTOS where "ID_AJUSTE_PROD"=?';
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($ID_AJUSTE_PROD));
        Database::disconnect();
    }

    // METODO PARA ACTUALIZAR UN AJUSTE (CABECERA)
    public function actualizarCabAjuste($ID_AJUSTE_PROD, $MOTIVO_AJUSTE_PROD) {
        $pdo = Database::connect();
        $sql = 'update INV_TAB_AJUSTES_PRODUCTOS set "MOTIVO_AJUSTE_PROD"=?, "FECHA_AJUSTE_PROD"=CURRENT_TIMESTAMP  where "ID_AJUSTE_PROD"=?';
        $consulta = $pdo->prepare($sql);
        try {
            $consulta->execute(array($MOTIVO_AJUSTE_PROD, $ID_AJUSTE_PROD));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
 // erika METODO PARA ACTUALIZAR LA FECHA DE IMPRESION Y CAMBIAR EL ESTADO DE IMPRESION 
    public function actualizarImpAjuste($ID_AJUSTE_PROD) {
        $pdo = Database::connect();
                if($this->getCabAjuste($ID_AJUSTE_PROD)->getFECHA_IMP_AJUSTE_PROD()!=null){
                    $sql = "update INV_TAB_AJUSTES_PRODUCTOS set ESTADO_IMP_AJUSTE_PROD='S' where ID_AJUSTE_PROD=?";
                }else{
                    $sql = "update INV_TAB_AJUSTES_PRODUCTOS set FECHA_IMP_AJUSTE_PROD=CURRENT_TIMESTAMP,ESTADO_IMP_AJUSTE_PROD='S' where ID_AJUSTE_PROD=?"; 
                }
        $consulta = $pdo->prepare($sql);
        try {
            $consulta->execute(array($ID_AJUSTE_PROD));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    // METODO PARA GENERAR AUTOMATICAMENTE EL CODIGO DE AJUSTE (CABECERA) -- AJUS-0001
    public function generarCodigoAjuste() {
        $pdo = Database::connect();
        $sql = 'select max("ID_AJUSTE_PROD") as cod from INV_TAB_AJUSTES_PRODUCTOS';
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $nuevoCod = '';
        if ($res['cod'] == NULL) {
            $nuevoCod = 'AJUS-0001';
        } else {
            $rest = ((substr($res['cod'], -4)) + 1) . ''; // Separacion de la parte numerica AJUS-0023  --> 23
            // Ciclo que completa el codigo segun lo retornado para completar los 9 caracteres 
            // AJUS-00 --> 67, AJUS-0 --> 786
            if ($rest > 1 && $rest <= 9) {
                $nuevoCod = 'AJUS-000' . $rest;
            } else {
                if ($rest >= 10 && $rest <= 99) {
                    $nuevoCod = 'AJUS-00' . $rest;
                } else {
                    if ($rest >= 100 && $rest <= 999) {
                        $nuevoCod = 'AJUS-0' . $rest;
                    } else {
                        $nuevoCod = 'AJUS-' . $rest;
                    }
                }
            }
        }
        Database::disconnect();
        return $nuevoCod; // RETORNO DEL NUEVO CODIGO DE AJUSTE
    }

    // METODO PARA GENERAR AUTOMATICAMENTE EL CODIGO DE DETALLE DE AJUSTE DESDE LA BASE DE DATOS -- DAJU-0001
    public function generarCodigoDetalleAjusteBD() {
        $pdo = Database::connect();
        $sql = 'select max("ID_DETALLE_AJUSTE_PROD") as cod from inv_tab_detalle_ajuste_prod';
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $nuevoCod = '';
        if ($res['cod'] == NULL) {
            $nuevoCod = 'DAJU-0001';
        } else {
            $rest = ((substr($res['cod'], -4)) + 1) . ''; // Separacion de la parte numerica DAJU-0023  --> 23
            // Ciclo que completa el codigo segun lo retornado para completar los 9 caracteres 
            // DAJU-00 --> 67, DAJU-0 --> 786
            if ($rest > 1 && $rest <= 9) {
                $nuevoCod = 'DAJU-000' . $rest;
            } else {
                if ($rest >= 10 && $rest <= 99) {
                    $nuevoCod = 'DAJU-00' . $rest;
                } else {
                    if ($rest >= 100 && $rest <= 999) {
                        $nuevoCod = 'DAJU-0' . $rest;
                    } else {
                        $nuevoCod = 'DAJU-' . $rest;
                    }
                }
            }
        }
        Database::disconnect();
        return $nuevoCod; // RETORNO DEL NUEVO CODIGO DE AJUSTE
    }

    // METODO PARA GENERAR AUTOMATICAMENTE EL CODIGO DE DETALLE DE AJUSTE DESDE EL ARRAY -- DAJU-0001
    public function generarCodigoDetalleAjusteArray($ultimaFilaArray) {
        $ultimoCodigo = $ultimaFilaArray->getID_DETALLE_AJUSTE_PROD();
        $rest = ((substr($ultimoCodigo, -4)) + 1) . ''; // Separacion de la parte numerica DAJU-0023  --> 23
        // Ciclo que completa el codigo segun lo retornado para completar los 9 caracteres 
        // DAJU-00 --> 67, DAJU-0 --> 786
        if ($rest > 1 && $rest <= 9) {
            $nuevoCod = 'DAJU-000' . $rest;
        } else {
            if ($rest >= 10 && $rest <= 99) {
                $nuevoCod = 'DAJU-00' . $rest;
            } else {
                if ($rest >= 100 && $rest <= 999) {
                    $nuevoCod = 'DAJU-0' . $rest;
                } else {
                    $nuevoCod = 'DAJU-' . $rest;
                }
            }
        }
        return $nuevoCod; // RETORNO DEL NUEVO CODIGO DE AJUSTE
    }

    // M E T O D O S   C R U D   D E   D E T A L L E S   D E   A J U S T E
    // METODO PARA ADICIONAR UN DETALLE DE AJUSTE
    public function adicionarDetalle($listaAjusteDet, $ID_PROD, $ID_USU, $tipoMovimiento, $cantidad) {
        //buscamos el producto:
        $productoModel = new ProductosModel();
        $producto = $productoModel->getProducto($ID_PROD);

        //Creamos un nuevo detalle AjusteDet:
        $id_detalle_ajuste = null;
        if (!empty($listaAjusteDet)) {
            $id_detalle_ajuste = $this->generarCodigoDetalleAjusteArray(end($listaAjusteDet));
        } else {
            $id_detalle_ajuste = $this->generarCodigoDetalleAjusteBD();
        }
        $ajusteDet = new AjusteDet($id_detalle_ajuste,$ID_PROD,$producto->getNOMBRE_PROD(),$producto->getPVP_PROD(),null,$ID_USU,$cantidad,$tipoMovimiento);

        if (!isset($listaAjusteDet)) {
            $listaAjusteDet = array();
        }

        //adicionamos el nuevo detalle al array en memoria:
        array_push($listaAjusteDet, $ajusteDet);
        return $listaAjusteDet;
    }
         //CONSULTA A REALIZAR
    // METODO PARA OBTENER DETALLES DE UN AJUSTE
    public function getDetallesAjuste($ID_AJUSTE_PROD) {
        $pdo = Database::connect();
        $sql = "select D.ID_DETALLE_AJUSTE_PROD, P.ID_PROD, P.NOMBRE_PROD, P.PVP_PROD, "
                . "D.ID_AJUSTE_PROD, U.ID_USU, D.CAMBIO_STOCK_PROD, D.TIPOMOV_DETAJUSTE_PROD "
                . "from INV_TAB_DETALLE_AJUSTE_PROD D, INV_TAB_PRODUCTOS P, INV_TAB_USUARIOS U "
                . "where D.ID_AJUSTE_PROD='$ID_AJUSTE_PROD' AND P.ID_PROD=D.ID_PROD AND U.ID_USU=D.ID_USU";
        $resultado = $pdo->query($sql);
        $listadoDetAjustes = array();
        foreach ($resultado as $res) {
            if($res['TIPOMOV_DETAJUSTE_PROD']=="S"){
                $res['CAMBIO_STOCK_PROD']=$res['CAMBIO_STOCK_PROD']*-1;
            }
            $ajusteDet = new ajusteDet($res['ID_DETALLE_AJUSTE_PROD'], $res['ID_PROD'], $res['NOMBRE_PROD'], $res['PVP_PROD'], $res['ID_AJUSTE_PROD'], $res['ID_USU'], $res['CAMBIO_STOCK_PROD'], $res['TIPOMOV_DETAJUSTE_PROD']);
            array_push($listadoDetAjustes, $ajusteDet);
        }
        Database::disconnect();
        return $listadoDetAjustes;
    }

    // METODO PARA ELIMINAR UN DETALLE DE AJUSTE
    public function eliminarDetalle($listaAjusteDet, $ID_DETALLE_AJUSTE_PROD) {
        //buscamos el DETALLE:
        $cont = 0;
        foreach ($listaAjusteDet as $det) {
            if ($det->getID_DETALLE_AJUSTE_PROD() == $ID_DETALLE_AJUSTE_PROD) {
                unset($listaAjusteDet[$cont]);
                //reindexamos el array para eliminar el lugar vacio:
                $listaAjusteDet = array_values($listaAjusteDet);
                break;
            }
            $cont++;
        }
        return $listaAjusteDet;
    }
     //CONSULTA A REALIZAR
    // METODO PARA OBTENER UN DETALLE DE AJUSTE
    public function getDetalle($ID_DETALLE_AJUSTE_PROD) {
        $pdo = Database::connect();
        $sql = "select D.ID_DETALLE_AJUSTE_PROD, P.ID_PROD, P.NOMBRE_PROD, P.PVP_PROD, "
                . "D.ID_AJUSTE_PROD, U.ID_USU, D.CAMBIO_STOCK_PROD, D.TIPOMOV_DETAJUSTE_PROD "
                . "from INV_TAB_DETALLE_AJUSTE_PROD D, INV_TAB_PRODUCTOS P, INV_TAB_USUARIOS U "
                . "where ID_DETALLE_AJUSTE_PROD=? AND P.ID_PROD=D.ID_PROD AND U.ID_USU=D.ID_USU";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($ID_DETALLE_AJUSTE_PROD));
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $detalle = new AjusteDet($res['ID_DETALLE_AJUSTE_PROD'], $res['ID_PROD'], $res['NOMBRE_PROD'], $res['PVP_PROD'], $res['ID_AJUSTE_PROD'], $res['ID_USU'], $res['CAMBIO_STOCK_PROD'], $res['TIPOMOV_DETAJUSTE_PROD']);
        Database::disconnect();
        return $detalle;
    }

    // METODO PARA INSERTAR UN AJUSTE CON DETALLES
    public function insertarAjusteDetalles($listaAjusteDet, $ID_AJUSTE_PROD, $MOTIVO_AJUSTE_PROD) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'insert into INV_TAB_AJUSTES_PRODUCTOS("ID_AJUSTE_PROD","MOTIVO_AJUSTE_PROD") values(?,?)';
        $consulta = $pdo->prepare($sql);
        try {
            $consulta->execute(array($ID_AJUSTE_PROD, $MOTIVO_AJUSTE_PROD));
            //guardamos los detalles:
            foreach ($listaAjusteDet as $det) {
                $sql = 'insert into inv_tab_detalle_ajuste_prod("ID_DETALLE_AJUSTE_PROD", "ID_PROD", "ID_AJUSTE_PROD", "ID_USU", "CAMBIO_STOCK_PROD", "TIPOMOV_DETAJUSTE_PROD") values(?,?,?,?,?,?)';
                $consulta = $pdo->prepare($sql);
                //en cada detalle asignamos el numero de ajuste padre:
                if ($det->getTIPOMOV_DETAJUSTE_PROD() == "I") {
                    $cantidad = $det->getCAMBIO_STOCK_PROD();
                } else {
                    $cantidad = $det->getCAMBIO_STOCK_PROD() * -1;
                }
                $consulta->execute(array($det->getID_DETALLE_AJUSTE_PROD(),
                    $det->getID_PROD(),
                    $ID_AJUSTE_PROD,
                    $det->getID_USU(),
                    $cantidad,
                    $det->getTIPOMOV_DETAJUSTE_PROD()));
            }
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    // METODO PARA GUARDAR LOS CAMBIOS DEL AJUSTE
    public function actualizarAjusteDetalles($listaAjusteDet, $listaDetPorEliminar, $ID_AJUSTE_PROD, $MOTIVO_AJUSTE_PROD) {
        $pdo = Database::connect();
        $sql = 'update INV_TAB_AJUSTES_PRODUCTOS SET "MOTIVO_AJUSTE_PROD"=? WHERE "ID_AJUSTE_PROD"=?';
        $consulta = $pdo->prepare($sql);
        try {
            $consulta->execute(array($MOTIVO_AJUSTE_PROD, $ID_AJUSTE_PROD));
            //guardamos los detalles:
            foreach ($listaAjusteDet as $det) {
                if (is_null($this->getDetalle($det->getID_DETALLE_AJUSTE_PROD())->getID_DETALLE_AJUSTE_PROD())) {
                    $sql = 'insert into inv_tab_detalle_ajuste_prod("ID_DETALLE_AJUSTE_PROD", "ID_PROD", "ID_AJUSTE_PROD", "ID_USU", "CAMBIO_STOCK_PROD", "TIPOMOV_DETAJUSTE_PROD") values(?,?,?,?,?,?)';
                    $consulta = $pdo->prepare($sql);
                    //en cada detalle asignamos el numero de ajuste padre:
                    if ($det->getTIPOMOV_DETAJUSTE_PROD() == "I") {
                        $cantidad = $det->getCAMBIO_STOCK_PROD();
                    } else {
                        $cantidad = $det->getCAMBIO_STOCK_PROD() * -1;
                    }
                    $consulta->execute(array($det->getID_DETALLE_AJUSTE_PROD(),
                        $det->getID_PROD(),
                        $ID_AJUSTE_PROD,
                        $det->getID_USU(),
                        $cantidad,
                        $det->getTIPOMOV_DETAJUSTE_PROD()));
                }
            }

            // Eliminacion de detalles en la edición
            foreach ($listaDetPorEliminar as $elim) {
                if (!is_null($this->getDetalle($elim)->getID_DETALLE_AJUSTE_PROD())) {
                    $sql = 'delete from inv_tab_detalle_ajuste_prod where "ID_DETALLE_AJUSTE_PROD"=?';
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute(array($elim));
                }
            }
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
         //REALIZAR ESTA CONSULTA
    public function getDetAjustes($ID_AJUSTE_PROD) {
        $pdo = Database::connect();
        $sql = "select D.ID_DETALLE_AJUSTE_PROD, P.NOMBRE_PROD,	D.CAMBIO_STOCK_PROD, D.TIPOMOV_DETAJUSTE_PROD, "
                . "P.COSTO_PROD, P.GRABA_IVA_PROD, D.ID_AJUSTE_PROD "
                . "from INV_TAB_DETALLE_AJUSTE_PROD D, INV_TAB_PRODUCTOS P "
                . "where D.ID_AJUSTE_PROD='$ID_AJUSTE_PROD' AND P.ID_PROD=D.ID_PROD";
        $resultado = $pdo->query($sql);
        $listadoDetAjustes = array();
        foreach ($resultado as $res) {
            $VistaDet_ajuste = new VistaAjusteDet($res['ID_DETALLE_AJUSTE_PROD'], $res['NOMBRE_PROD'], $res['CAMBIO_STOCK_PROD'], $res['TIPOMOV_DETAJUSTE_PROD'], $res['COSTO_PROD'], $res['GRABA_IVA_PROD'], $res['ID_AJUSTE_PROD']);
            array_push($listadoDetAjustes, $VistaDet_ajuste);
        }
        Database::disconnect();
        return $listadoDetAjustes;
    }

}
