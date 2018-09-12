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
          if($tarjeta->pagar()==TRUE){
              if($tarjeta->usoplus()==TRUE){
                         $boleto = new Boleto("viaje plus",$this,$tarjeta);
                          return $boleto;
                } 
            else {
                 $boleto = new Boleto($tarjeta->monto,$this,$tarjeta);
                          return $boleto;
                 }
              
         } 

             else
              {
                  return FALSE;
                  
               }
    }

}
