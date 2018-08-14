<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {

    /**
     * Comprueba que la tarjeta aumenta su saldo cuando se carga saldo válido.
     */
    public function testCargaSaldo() {
        $tarjeta = new Tarjeta();

        $tarjeta->recargar(10);
        $this->assertEquals($tarjeta->obtenerSaldo(), 10);

        $tarjeta->recargar(20);
        $this->assertEquals($tarjeta->obtenerSaldo(), 30);
        
        $tarjeta->recargar(30); 
        $this->assertEquals($tarjeta->obtenerSaldo(), 60); 
        
        $tarjeta->recargar(50); 
        $this->assertEquals($tarjeta->obtenerSaldo(),110);

        $tarjeta->recargar(100); 
        $this->assertEquals($tarjeta->obtenerSaldo(),210);

        $tarjeta->recargar(510.15); 
        $this->assertEquals($tarjeta->obtenerSaldo(),702.08); 

        $tarjeta->recargar(962.59);  
        $this->assertEquals($tarjeta->obtenerSaldo(),1886.25);

    }

    /**
     * Comprueba que la tarjeta no puede cargar saldos invalidos.
     */
    public function testCargaSaldoInvalido() {
      $tarjeta = new Tarjeta();

      $tarjeta->recargar(15);
      $this->assertEquals($tarjeta->obtenerSaldo(), 0);
  }
}
