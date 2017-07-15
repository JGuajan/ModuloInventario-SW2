<?php

class VistaAjusteDet {
    private $ID_DETALLE_AJUSTE_PROD;
    private $NOMBRE_PROD;
    private $CAMBIO_STOCK_PROD;
    private $TIPOMOV_DETAJUSTE_PROD;
    private $PVP_PROD;   
    private $GRABA_IVA_PROD;
    private $ID_AJUSTE_PROD;
    
    public function __construct($ID_DETALLE_AJUSTE_PROD, $NOMBRE_PROD, $CAMBIO_STOCK_PROD, $TIPOMOV_DETAJUSTE_PROD, $PVP_PROD, $GRABA_IVA_PROD, $ID_AJUSTE_PROD) {
        $this->ID_DETALLE_AJUSTE_PROD = $ID_DETALLE_AJUSTE_PROD;
        $this->NOMBRE_PROD = $NOMBRE_PROD;
        $this->CAMBIO_STOCK_PROD = $CAMBIO_STOCK_PROD;
        $this->TIPOMOV_DETAJUSTE_PROD = $TIPOMOV_DETAJUSTE_PROD;
        $this->PVP_PROD = $PVP_PROD;
        $this->GRABA_IVA_PROD = $GRABA_IVA_PROD;
        $this->ID_AJUSTE_PROD = $ID_AJUSTE_PROD;
    }

    
    public function getID_DETALLE_AJUSTE_PROD() {
        return $this->ID_DETALLE_AJUSTE_PROD;
    }

    public function getNOMBRE_PROD() {
        return $this->NOMBRE_PROD;
    }

    public function getCAMBIO_STOCK_PROD() {
        return $this->CAMBIO_STOCK_PROD;
    }

    public function getTIPOMOV_DETAJUSTE_PROD() {
        return $this->TIPOMOV_DETAJUSTE_PROD;
    }

    public function getPVP_PROD() {
        return $this->PVP_PROD;
    }

    public function getGRABA_IVA_PROD() {
        return $this->GRABA_IVA_PROD;
    }

    public function getID_AJUSTE_PROD() {
        return $this->ID_AJUSTE_PROD;
    }

    public function setID_DETALLE_AJUSTE_PROD($ID_DETALLE_AJUSTE_PROD) {
        $this->ID_DETALLE_AJUSTE_PROD = $ID_DETALLE_AJUSTE_PROD;
    }

    public function setNOMBRE_PROD($NOMBRE_PROD) {
        $this->NOMBRE_PROD = $NOMBRE_PROD;
    }

    public function setCAMBIO_STOCK_PROD($CAMBIO_STOCK_PROD) {
        $this->CAMBIO_STOCK_PROD = $CAMBIO_STOCK_PROD;
    }

    public function setTIPOMOV_DETAJUSTE_PROD($TIPOMOV_DETAJUSTE_PROD) {
        $this->TIPOMOV_DETAJUSTE_PROD = $TIPOMOV_DETAJUSTE_PROD;
    }

    public function setPVP_PROD($PVP_PROD) {
        $this->PVP_PROD = $PVP_PROD;
    }

    public function setGRABA_IVA_PROD($GRABA_IVA_PROD) {
        $this->GRABA_IVA_PROD = $GRABA_IVA_PROD;
    }

    public function setID_AJUSTE_PROD($ID_AJUSTE_PROD) {
        $this->ID_AJUSTE_PROD = $ID_AJUSTE_PROD;
    }



}
