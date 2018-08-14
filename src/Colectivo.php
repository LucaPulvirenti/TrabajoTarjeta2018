<?php

namespace TrabajoTarjeta;

class Colectivo implements ColectivoInterface {

    protected $linea; 
    protected $empresa;
    protected $numero;

    public function __construct($l,$e,$n){
        $this->linea=$l;
        $this->empresa=$e; 
        $this->numero=$n;

    }

    public function linea(){
        return $this->linea;
    }

    public function empresa(){
        return $this->empresa;
    }

    public function numero(){
        return $this->numero;
    }

    public function pagarCon(TarjetaInterface $tarjeta){
        if ($tarjeta->obtenerSaldo()>=14.80) 
        {
            $boleto = new Boleto(14.80,$this,$tarjeta);
            $tarjeta->restarSaldo($boleto->obtenerValor()); 
            return $boleto;

        } 
        else 
        {
            return FALSE;
        }

    }

}
