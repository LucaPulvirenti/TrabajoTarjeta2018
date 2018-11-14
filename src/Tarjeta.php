<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    
    protected $saldo;
    public $monto = 14.8;
    protected $viajeplus;
    protected $ID;
    protected $ultboleto;
    protected $tipo; 
    protected $tiempo;
    protected $ultimoplus = FALSE;

    public function __construct(TiempoInterface $tiempo){
      $this->saldo = 0.0;
      $this->viajeplus = 0;
      $this->ID = rand(0,100);
      $this->ultboleto = NULL; 
      $this->tiempo = $tiempo;
    }

    public function DevolverTiempo(){

      return $this->tiempo;
    } 

     public function usoplus(){
               
    return $this->ultimoplus;
          }  

    public function CantidadPlus(){ 
      return $this->viajeplus;

    }


    public function IncrementoPlus(){

      $this->viajeplus +=1;
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

     public function pagar(){ 
    if (get_class($tarjeta) == "TrabajoTarjeta/MedioBoleto" && $tarjeta->obtenerUltBoleto() != NULL) 

    {
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
                        if ($this->saldoSuficiente()) 
                        {   
                            $this->restarSaldo();

                            return TRUE; 
                         }
                          else{

                            if ($tarjeta->CantidadPlus()<2  and ($this->obtenerSaldo()>=0)) 
                            {
                                $this->ultimoplus = TRUE;
                                $this->IncrementoPlus();
                                return TRUE;
                                
                            }
                            else 
                            {
                               return FALSE;
                            }
                        }
             }

          }
  }

  else { 

     if ($this->saldoSuficiente()) 
                        {   
                            $this->restarSaldo();

                            return TRUE; 
                         }
                          else{

                            if ($tarjeta->CantidadPlus()<2  and ($this->obtenerSaldo()>=0)) 
                            {
                                $this->ultimoplus = TRUE;
                                $this->IncrementoPlus();
                                return TRUE;
                                
                            }
                            else 
                            {
                               return FALSE;
                            }
            
  }




            }




    public function recargar($monto) {
      
      if($this->viajeplus==0){
       
      if ($monto == 10 || $monto==20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
          if( $monto == 962.59) { 
            $this->saldo += ($monto + 221.58);
            return true;
          }
          else{
            if ($monto == 510.15){
              $this->saldo += ($monto+81.93);
              return true;
            }
            else{
                $this->saldo += $monto;
                return true;
            }
          }
      }
      else 
      {
        //echo "El monto ingresado no es valido";
        return false;

      }

    }  
     
     if($this->viajeplus==1){
       
      if ($monto == 10 || $monto==20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
          if( $monto == 962.59) { 
            $this->saldo += ($monto + 221.58 - 14.8);
            $this->viajeplus=0;
            return true;
          }
          else{
            if ($monto == 510.15){
              $this->saldo += ($monto+81.93 - 14.8);
              $this->viajeplus=0;
              return true;
            }
            else{
                $this->saldo += ($monto- 14.8);
                $this->viajeplus=0;
                return true;
            }
          }

      }
      else 
      {
        //echo "El monto ingresado no es valido";
        return false;
      }
    } 
      if($this->viajeplus==2){
       
      if ($monto == 10 || $monto==20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
          if( $monto == 962.59) { 
            $this->saldo += ($monto + 221.58 - 29.6);
            $this->viajeplus=0;
            return true;
          }
          else{
            if ($monto == 510.15){
              $this->saldo += ($monto+81.93 - 29.6);
              $this->viajeplus=0;
              return true;
            }
            else{
                $this->saldo += ($monto- 29.6);
                $this->viajeplus=0;
                return true;
            }
          } 
          
      }
      
      else 
      {
        //echo "El monto ingresado no es valido";
        return false;
      }

    }
  } 

    /**
     * Devuelve el saldo que le queda a la tarjeta.
     *
     * @return float
     */
    public function obtenerSaldo() {
      return $this->saldo;
    }

    public function restarSaldo() 
    {
      $this->saldo -= ($this->monto+$this->CantidadPlus()*$this->monto);
      $this->viajeplus = 0;
    }  

    public function obtenerID(){
      return $this->ID;
    }

    public function guardarUltimoBoleto($boleto){
      $this->ultboleto = $boleto;


    }

    public function obtenerUltBoleto(){
      return $this->ultboleto;
    }
}