<?php

// Clase Reporte de Detalles de Factura de Venta de Producto

class RepDetFacVenta {
    private $CANTIDAD_DET_FAC_VENTA;
    private $ID_CAB_FAC_VENTA;
    private $ID_DET_FAC_VENTA;
    private $DESCRIPCION_PROD;
    private $PVPUNIT_DET_FAC_VENTA;
    private $PVPTOT_DET_FAC_VENTA;
    
    // Constructor de la Clase Reporte de Detalles de Factura de Venta de Producto
    public function __construct($CANTIDAD_DET_FAC_VENTA, $ID_CAB_FAC_VENTA, $ID_DET_FAC_VENTA, $DESCRIPCION_PROD, $PVPUNIT_DET_FAC_VENTA, $PVPTOT_DET_FAC_VENTA) {
        $this->CANTIDAD_DET_FAC_VENTA = $CANTIDAD_DET_FAC_VENTA;
        $this->ID_CAB_FAC_VENTA = $ID_CAB_FAC_VENTA;
        $this->ID_DET_FAC_VENTA = $ID_DET_FAC_VENTA;
        $this->DESCRIPCION_PROD = $DESCRIPCION_PROD;
        $this->PVPUNIT_DET_FAC_VENTA = $PVPUNIT_DET_FAC_VENTA;
        $this->PVPTOT_DET_FAC_VENTA = $PVPTOT_DET_FAC_VENTA;
    }

        //Métodos para la obtención (get) y modificación (set) de los atributos de Reporte de Factura de Venta de Producto
        public function getCANTIDAD_DET_FAC_VENTA() {
            return $this->CANTIDAD_DET_FAC_VENTA;
        }

        public function getID_CAB_FAC_VENTA() {
            return $this->ID_CAB_FAC_VENTA;
        }

        public function getID_DET_FAC_VENTA() {
            return $this->ID_DET_FAC_VENTA;
        }

        public function getDESCRIPCION_PROD() {
            return $this->DESCRIPCION_PROD;
        }

        public function getPVPUNIT_DET_FAC_VENTA() {
            return $this->PVPUNIT_DET_FAC_VENTA;
        }

        public function getPVPTOT_DET_FAC_VENTA() {
            return $this->PVPTOT_DET_FAC_VENTA;
        }

        public function setCANTIDAD_DET_FAC_VENTA($CANTIDAD_DET_FAC_VENTA) {
            $this->CANTIDAD_DET_FAC_VENTA = $CANTIDAD_DET_FAC_VENTA;
        }

        public function setID_CAB_FAC_VENTA($ID_CAB_FAC_VENTA) {
            $this->ID_CAB_FAC_VENTA = $ID_CAB_FAC_VENTA;
        }

        public function setID_DET_FAC_VENTA($ID_DET_FAC_VENTA) {
            $this->ID_DET_FAC_VENTA = $ID_DET_FAC_VENTA;
        }

        public function setDESCRIPCION_PROD($DESCRIPCION_PROD) {
            $this->DESCRIPCION_PROD = $DESCRIPCION_PROD;
        }

        public function setPVPUNIT_DET_FAC_VENTA($PVPUNIT_DET_FAC_VENTA) {
            $this->PVPUNIT_DET_FAC_VENTA = $PVPUNIT_DET_FAC_VENTA;
        }

        public function setPVPTOT_DET_FAC_VENTA($PVPTOT_DET_FAC_VENTA) {
            $this->PVPTOT_DET_FAC_VENTA = $PVPTOT_DET_FAC_VENTA;
        }


}
