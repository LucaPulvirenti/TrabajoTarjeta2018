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
        if ($tarjeta->obtenerSaldo()>=$tarjeta->monto) 
        {
            $boleto = new Boleto($tarjeta->monto,$this,$tarjeta);
            $tarjeta->restarSaldo(); 
            return $boleto;

        } 
        else 
        {
            return FALSE;
            

        }

    }

}
