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

    public function saldoSuficiente(TarjetaInterface $tarjeta){ 
         if ($tarjeta->obtenerSaldo()>=($tarjeta->monto+$tarjeta->CantidadPlus()*$tarjeta->monto)) 
         {
            return TRUE;
         } 
         else  {
            return FALSE;
         }

    }

        
    public function pagarCon(TarjetaInterface $tarjeta){
        if ($this->saldoSuficiente($tarjeta)) 
        {   
            $tarjeta->restarSaldo();
            if ($tarjeta->CantidadPlus()>0) {
                $boleto = new Boleto($tarjeta->monto,$this,$tarjeta, "NORMAL", "Paga ".(string)$tarjeta->CantidadPlus()." Viaje Plus");
            }
            else {
            $boleto = new Boleto($tarjeta->monto,$this,$tarjeta, "NORMAL", " ");
            }
            return $boleto;

        }  
        else{

            if ($tarjeta->CantidadPlus()<2) 
            {
                $boleto= new Boleto (0.0,$this,$tarjeta, "VIAJE PLUS"," ") ;
                $tarjeta->IncrementoPlus();
                return $boleto;
            }
            else 
            {
               return FALSE;
            }
        }
      
    }

}
