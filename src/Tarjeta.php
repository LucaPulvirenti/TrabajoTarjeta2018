<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    
    protected $saldo=0.0;
    public $monto=14.8;
    protected $viajeplus = 0;

    public function recargar($monto) {
      if(viajeplus==0){
       
      if ($monto == 10 || $monto==20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
          if( $monto == 962.59) { 
            $this->saldo += ($monto + 221.58);
          } 

          if ($monto == 510.15){
               $this->saldo += ($monto+81.93);
           }
          else {
                $this->saldo += $monto;
              }
          
      }
      else 
      {
        echo "El monto ingresado no es valido";
      }

    } 
    if(viajeplus==1) 
    {
       if ($monto == 10 || $monto==20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
          if( $monto == 962.59) { 
            $this->saldo += ($monto + (221.58-14.8));
          } 

          if ($monto == 510.15){
               $this->saldo += ($monto+(81.93-14.8));
           }
          else {
                $this->saldo += ($monto-14.8);
              } 
           $this->viajeplus==0;
          
      }
      else 
      {
        echo "El monto ingresado no es valido";
      }

    }
        if(viajeplus==2) 
    {
       if ($monto == 10 || $monto==20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
          if( $monto == 962.59) { 
            $this->saldo += ($monto + (221.58-29.6));
          } 

          if ($monto == 510.15){
               $this->saldo += ($monto+(81.93-29.6));
           }
          else {
                $this->saldo += ($monto-29.6);
              }
          $this->viajeplus==0;
      }
      else 
      {
        echo "El monto ingresado no es valido";
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
      $this->saldo -= $this->monto;
    } 

    public function 

}