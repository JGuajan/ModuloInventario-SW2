<?php

// Clase Reporte de Detalles de Factura de Compra de Producto

class RepDetFacCompra {
    private $CANTIDAD_DET_FAC_COMPRA;
    private $ID_CAB_FAC_COMPRA;
    private $ID_DET_FAC_COMPRA;
    private $DESCRIPCION_PROD;
    private $PVPUNIT_DET_FAC_COMPRA;
    private $PVPTOT_DET_FAC_COMPRA;
    
    // Constructor de la Clase Reporte de Detalles de Factura de Compra de Producto
    public function __construct($CANTIDAD_DET_FAC_COMPRA, $ID_CAB_FAC_COMPRA, $ID_DET_FAC_COMPRA, $DESCRIPCION_PROD, $PVPUNIT_DET_FAC_COMPRA, $PVPTOT_DET_FAC_COMPRA) {
        $this->CANTIDAD_DET_FAC_COMPRA = $CANTIDAD_DET_FAC_COMPRA;
        $this->ID_CAB_FAC_COMPRA = $ID_CAB_FAC_COMPRA;
        $this->ID_DET_FAC_COMPRA = $ID_DET_FAC_COMPRA;
        $this->DESCRIPCION_PROD = $DESCRIPCION_PROD;
        $this->PVPUNIT_DET_FAC_COMPRA = $PVPUNIT_DET_FAC_COMPRA;
        $this->PVPTOT_DET_FAC_COMPRA = $PVPTOT_DET_FAC_COMPRA;
    }

    //Métodos para la obtención (get) y modificación (set) de los atributos de Reporte de Factura de Venta de Producto
    public function getCANTIDAD_DET_FAC_COMPRA() {
        return $this->CANTIDAD_DET_FAC_COMPRA;
    }

    public function getID_CAB_FAC_COMPRA() {
        return $this->ID_CAB_FAC_COMPRA;
    }

    public function getID_DET_FAC_COMPRA() {
        return $this->ID_DET_FAC_COMPRA;
    }

    public function getDESCRIPCION_PROD() {
        return $this->DESCRIPCION_PROD;
    }

    public function getPVPUNIT_DET_FAC_COMPRA() {
        return $this->PVPUNIT_DET_FAC_COMPRA;
    }

    public function getPVPTOT_DET_FAC_COMPRA() {
        return $this->PVPTOT_DET_FAC_COMPRA;
    }

    public function setCANTIDAD_DET_FAC_COMPRA($CANTIDAD_DET_FAC_COMPRA) {
        $this->CANTIDAD_DET_FAC_COMPRA = $CANTIDAD_DET_FAC_COMPRA;
    }

    public function setID_CAB_FAC_COMPRA($ID_CAB_FAC_COMPRA) {
        $this->ID_CAB_FAC_COMPRA = $ID_CAB_FAC_COMPRA;
    }

    public function setID_DET_FAC_COMPRA($ID_DET_FAC_COMPRA) {
        $this->ID_DET_FAC_COMPRA = $ID_DET_FAC_COMPRA;
    }

    public function setDESCRIPCION_PROD($DESCRIPCION_PROD) {
        $this->DESCRIPCION_PROD = $DESCRIPCION_PROD;
    }

    public function setPVPUNIT_DET_FAC_COMPRA($PVPUNIT_DET_FAC_COMPRA) {
        $this->PVPUNIT_DET_FAC_COMPRA = $PVPUNIT_DET_FAC_COMPRA;
    }

    public function setPVPTOT_DET_FAC_COMPRA($PVPTOT_DET_FAC_COMPRA) {
        $this->PVPTOT_DET_FAC_COMPRA = $PVPTOT_DET_FAC_COMPRA;
    } 

}
