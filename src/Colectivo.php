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
        if (saldoSuficiente($tarjeta)) 
        {
            $boleto = new Boleto($tarjeta->monto,$this,$tarjeta);
            $tarjeta->restarSaldo(); 
            return $boleto;

        }  
        else{

            if($tarjeta->viajeplus<3) 
            {
                $boleto= new Boleto ("viaje plus",$this,$tarjeta) ;
                $tarjeta->viajeplus += 1; 
            }
            else 
            {
                echo "no le quedan mas viajes plus";
            }
        }
      
    }

}
