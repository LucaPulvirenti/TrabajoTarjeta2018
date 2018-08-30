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
         if ($tarjeta->obtenerSaldo()>=$tarjeta->monto) 
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
            $boleto = new Boleto($tarjeta->monto,$this,$tarjeta);
           
            return $boleto;

        }  
        else{

            if( ($tarjeta->CantidadPlus()<2) and ($tarjeta->obtenerSaldo()>=0) ) 
            {
                $boleto= new Boleto ("viaje plus",$this,$tarjeta) ;
                $tarjeta->IncrementoPlus();
            }
            else 
            {
               return FALSE;
            }
        }
      
    }

}
