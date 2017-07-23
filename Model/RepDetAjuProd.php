<?php

// Clase Reporte de Detalles de Ajustes de Producto

class RepDetAjuProd {
    private $ID_AJUSTE_PROD;
    private $ID_DETALLE_AJUSTE_PROD;
    private $NOMAPE_USU;
    private $CAMBIO_STOCK_PROD;
    private $TIPOMOV_DETAJUSTE_PROD;
    
    // Constructor de la Clase Reporte de Detalles de Ajustes de Producto
    public function __construct($ID_AJUSTE_PROD, $ID_DETALLE_AJUSTE_PROD, $NOMAPE_USU, $CAMBIO_STOCK_PROD, $TIPOMOV_DETAJUSTE_PROD) {
        $this->ID_AJUSTE_PROD = $ID_AJUSTE_PROD;
        $this->ID_DETALLE_AJUSTE_PROD = $ID_DETALLE_AJUSTE_PROD;
        $this->NOMAPE_USU = $NOMAPE_USU;
        $this->CAMBIO_STOCK_PROD = $CAMBIO_STOCK_PROD;
        $this->TIPOMOV_DETAJUSTE_PROD = $TIPOMOV_DETAJUSTE_PROD;
    }

        //Métodos para la obtención (get) y modificación (set) de los atributos de Reporte de Detalles de Ajustes de Producto
        public function getID_AJUSTE_PROD() {
            return $this->ID_AJUSTE_PROD;
        }

        public function getID_DETALLE_AJUSTE_PROD() {
            return $this->ID_DETALLE_AJUSTE_PROD;
        }

        public function getNOMAPE_USU() {
            return $this->NOMAPE_USU;
        }

        public function getCAMBIO_STOCK_PROD() {
            return $this->CAMBIO_STOCK_PROD;
        }

        public function getTIPOMOV_DETAJUSTE_PROD() {
            return $this->TIPOMOV_DETAJUSTE_PROD;
        }

        public function setID_AJUSTE_PROD($ID_AJUSTE_PROD) {
            $this->ID_AJUSTE_PROD = $ID_AJUSTE_PROD;
        }

        public function setID_DETALLE_AJUSTE_PROD($ID_DETALLE_AJUSTE_PROD) {
            $this->ID_DETALLE_AJUSTE_PROD = $ID_DETALLE_AJUSTE_PROD;
        }

        public function setNOMAPE_USU($NOMAPE_USU) {
            $this->NOMAPE_USU = $NOMAPE_USU;
        }

        public function setCAMBIO_STOCK_PROD($CAMBIO_STOCK_PROD) {
            $this->CAMBIO_STOCK_PROD = $CAMBIO_STOCK_PROD;
        }

        public function setTIPOMOV_DETAJUSTE_PROD($TIPOMOV_DETAJUSTE_PROD) {
            $this->TIPOMOV_DETAJUSTE_PROD = $TIPOMOV_DETAJUSTE_PROD;
        }


}
