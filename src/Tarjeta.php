<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    
    protected $saldo=0.0;

    public function recargar($monto) {
      if ($monto == 10 || $monto==20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510.15 || $monto == 962.59) {
          if( $monto == 962.59) {
            $this->saldo += ($monto + 221.58);
          } 
          else {
              if ($monto == 510.15){
                $this->saldo += ($monto+81.93);
              } else {
                $this->saldo += $monto;
              }
          }
      }
      else 
      {
        echo "El monto ingresado no es valido";
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

    public function restarSaldo($boleto) 
    {
      $this->saldo -= $boleto;
    }

}