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
        if (get_class($tarjeta) == "TrabajoTarjeta/MedioBoleto" && $tarjeta->obtenerUltBoleto() != NULL){
           $ultimoboleto = $tarjeta->obtenerUltBoleto();
           $fechault = $boleto->obtenerFecha();
           $horault = $boleto->obtenerHora();
           $lista = explode(':', $horault);
           $h = (int)$lista[0];
           $m = (int)$lista[1];
           $s = (int)$lista[2];

           if ($fechault == date('d-m-Y')){
                if($h==(int)date('H') && $m+5<((int)date('m')))
                {
                        if ($this->saldoSuficiente($tarjeta)) 
                        {   
                            $tarjeta->restarSaldo(TRUE);
                            if ($tarjeta->CantidadPlus()>0) {
                                $boleto = new Boleto(($tarjeta->monto+$tarjeta->CantidadPlus()*$tarjeta->monto),$this,$tarjeta, "MEDIO", "Paga ".(string)$tarjeta->CantidadPlus()." Viaje Plus");
                            }
                            else {
                            $boleto = new Boleto(($tarjeta->monto+$tarjeta->CantidadPlus()*$tarjeta->monto),$this,$tarjeta, "MEDIO", " ");
                            }
                            $tarjeta->guardarUltimoBoleto($boleto);
                            return $boleto;

                        } 
                        else{

                            if ($tarjeta->CantidadPlus()<2) 
                            {
                                $boleto= new Boleto (0.0,$this,$tarjeta, "VIAJE PLUS"," ") ;
                                $tarjeta->IncrementoPlus();
                                $tarjeta->guardarUltimoBoleto($boleto);
                                return $boleto;
                            }
                            else 
                            {
                               return FALSE;
                            }
                        }
                }
                else
                {
                    if ($this->saldoSuficiente($tarjeta)) 
                        {   
                            $tarjeta->restarSaldo(FALSE);
                            if ($tarjeta->CantidadPlus()>0) {
                                $boleto = new Boleto(($tarjeta->monto*2+$tarjeta->CantidadPlus()*$tarjeta->monto*2),$this,$tarjeta, "NORMAL", "Paga ".(string)$tarjeta->CantidadPlus()." Viaje Plus");
                            }
                            else {
                            $boleto = new Boleto(($tarjeta->monto*2+$tarjeta->CantidadPlus()*$tarjeta->monto*2),$this,$tarjeta, "NORMAL", " ");
                            }
                            $tarjeta->guardarUltimoBoleto($boleto);
                            return $boleto;

                        } 
                        else{

                            if ($tarjeta->CantidadPlus()<2) 
                            {
                                $boleto= new Boleto (0.0,$this,$tarjeta, "VIAJE PLUS"," ") ;
                                $tarjeta->IncrementoPlus();
                                $tarjeta->guardarUltimoBoleto($boleto);
                                return $boleto;
                            }
                            else 
                            {
                               return FALSE;
                            }
                        }

                }
            }
            }
            else
            {
                        if ($this->saldoSuficiente($tarjeta)) 
                        {   
                            $tarjeta->restarSaldo(TRUE);
                            if ($tarjeta->CantidadPlus()>0) {
                                $boleto = new Boleto(($tarjeta->monto+$tarjeta->CantidadPlus()*$tarjeta->monto),$this,$tarjeta, "MEDIO", "Paga ".(string)$tarjeta->CantidadPlus()." Viaje Plus");
                            }
                            else {
                            $boleto = new Boleto(($tarjeta->monto+$tarjeta->CantidadPlus()*$tarjeta->monto),$this,$tarjeta, "MEDIO", " ");
                            }
                            $tarjeta->guardarUltimoBoleto($boleto);
                            return $boleto;

                        } 
                        else{

                            if ($tarjeta->CantidadPlus()<2) 
                            {
                                $boleto= new Boleto (0.0,$this,$tarjeta, "VIAJE PLUS"," ") ;
                                $tarjeta->IncrementoPlus();
                                $tarjeta->guardarUltimoBoleto($boleto);
                                return $boleto;
                            }
                        }
            }
        else
        {
            if ($this->saldoSuficiente($tarjeta)) 
            {   
                $tarjeta->restarSaldo();
                if ($tarjeta->CantidadPlus()>0) {
                    $boleto = new Boleto(($tarjeta->monto+$tarjeta->CantidadPlus()*$tarjeta->monto),$this,$tarjeta, "NORMAL", "Paga ".(string)$tarjeta->CantidadPlus()." Viaje Plus");
                }
                else {
                $boleto = new Boleto(($tarjeta->monto+$tarjeta->CantidadPlus()*$tarjeta->monto),$this,$tarjeta, "NORMAL", " ");
                }
                $tarjeta->guardarUltimoBoleto($boleto);
                return $boleto;

            }  
            else{

                if ($tarjeta->CantidadPlus()<2) 
                {
                    $boleto= new Boleto (0.0,$this,$tarjeta, "VIAJE PLUS"," ") ;
                    $tarjeta->IncrementoPlus();
                    $tarjeta->guardarUltimoBoleto($boleto);
                    return $boleto;
                }
                else 
                {
                   return FALSE;
                }
            }
        }
    }

}
