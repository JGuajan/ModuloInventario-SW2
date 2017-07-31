<?php

// Clase Reporte de Detalles de Factura de Compra de Producto

class RepDetFacCompra {
    private $iddetalle;
    private $idproducto;
    private $idfactura;
    private $cantidadproducto;
    private $descuento;
    private $cantdescuento;
    
    // Constructor de la Clase Reporte de Detalles de Factura de Compra de Producto
    public function __construct($iddetalle, $idproducto, $idfactura, $cantidadproducto, $descuento, $cantdescuento) {
        $this->iddetalle = $iddetalle;
        $this->idproducto = $idproducto;
        $this->idfactura = $idfactura;
        $this->cantidadproducto = $cantidadproducto;
        $this->descuento = $descuento;
        $this->cantdescuento = $cantdescuento;
    }

        //Métodos para la obtención (get) y modificación (set) de los atributos de Reporte de Factura de Venta de Producto
        public function getIddetalle() {
            return $this->iddetalle;
        }

        public function getIdproducto() {
            return $this->idproducto;
        }

        public function getIdfactura() {
            return $this->idfactura;
        }

        public function getCantidadproducto() {
            return $this->cantidadproducto;
        }

        public function getDescuento() {
            return $this->descuento;
        }

        public function getCantdescuento() {
            return $this->cantdescuento;
        }

        public function setIddetalle($iddetalle) {
            $this->iddetalle = $iddetalle;
        }

        public function setIdproducto($idproducto) {
            $this->idproducto = $idproducto;
        }

        public function setIdfactura($idfactura) {
            $this->idfactura = $idfactura;
        }

        public function setCantidadproducto($cantidadproducto) {
            $this->cantidadproducto = $cantidadproducto;
        }

        public function setDescuento($descuento) {
            $this->descuento = $descuento;
        }

        public function setCantdescuento($cantdescuento) {
            $this->cantdescuento = $cantdescuento;
        }



}
