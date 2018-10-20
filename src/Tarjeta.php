<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    
    protected $saldo;
    public $monto = 14.8;
    protected $viajeplus;
    protected $ID;

    public function __construct(){
      $this->saldo = 0.0;
      $this->viajeplus = 0;
      $this->ID = rand(0,100);
    }

    public function CantidadPlus(){ 
      return $this->viajeplus;

    }

    public function IncrementoPlus(){

      $this->viajeplus +=1;
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
}