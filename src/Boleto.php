<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;
    protected $colectivo; 
    public $tarjeta;
    protected $fecha;
    protected $saldo;
    protected $id;
    protected $tipo;
    protected $descripcion;
    
    public function __construct($valor, $colectivo, $tarjeta, $tipo, $descripcion) {
        $this->valor = $valor;
        $this->colectivo = $colectivo->linea();
        $this->tarjeta = get_class($tarjeta);
        $this->saldo = $tarjeta->obtenerSaldo();
        $this->id = $tarjeta->obtenerID();
        $this->fecha = date('d-m-Y H:i:s');
        $this->tipo;
        $this->descripcion;
        }

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */

    public function obtenerValor() {
        return $this->valor;
    }

    public function obtenerTipo() {
        return $this->$tipo;
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
