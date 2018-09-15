<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;
    protected $colectivo; 
    public $tarjeta;
    protected $fecha;
    
    public function __construct($valor, $colectivo, $tarjeta) {
        $this->valor = $valor;
        $this->colectivo = $colectivo->linea();
        $this->tarjeta = get_class($tarjeta);
        //$this->fecha = get_time();

    }

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */

    public function obtenerValor() {
        return $this->valor;
    }

    /**
     * Devuelve un objeto que respresenta el colectivo donde se viajó.
     *
     * @return ColectivoInterface
     */

    public function obtenerColectivo() { 
         return $this->colectivo;

    }

}
