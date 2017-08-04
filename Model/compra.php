<?php

class compra {
 
    private $ID_PROD;
    private $CANTIDAD;
    private $ESTADO;
   
    public function __construct($ID_PROD, $CANTIDAD, $ESTADO) {
        $this->ID_PROD = $ID_PROD;
        $this->CANTIDAD = $CANTIDAD;
        $this->ESTADO = $ESTADO;
    }

    public function getID_PROD() {
        return $this->ID_PROD;
    }

    public function getCANTIDAD() {
        return $this->CANTIDAD;
    }

    public function getESTADO() {
        return $this->ESTADO;
    }

    public function setID_PROD($ID_PROD) {
        $this->ID_PROD = $ID_PROD;
    }

    public function setCANTIDAD($CANTIDAD) {
        $this->CANTIDAD = $CANTIDAD;
    }

    public function setESTADO($ESTADO) {
        $this->ESTADO = $ESTADO;
    }


}
