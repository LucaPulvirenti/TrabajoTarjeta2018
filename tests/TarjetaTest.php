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
        $this->assertEquals($tarjeta->obtenerSaldo(),802.08); 

        $tarjeta->recargar(962.59);  
        $this->assertEquals($tarjeta->obtenerSaldo(),1986.25);

    }

    /**
     * Comprueba que la tarjeta no puede cargar saldos invalidos.
     */
    public function testCargaSaldoInvalido() {
      $tarjeta = new Tarjeta();

      $tarjeta->recargar(15);
      $this->assertEquals($tarjeta->obtenerSaldo(), 0);
  }


  public function testFranquiciaCompleta(){ 
      $colectivo = new Colectivo("134","mixta",30);  
      $franquicia = new FranquiciaCompleta(); 

      $this->assertEquals($franquicia->obtenerSaldo(),0.0);
      $this->assertEquals(get_class($coletivo->pagarCon($franquicia)),"Boleto");

  }

  public function testMedioBoleto(){ 
           $colectivo = new Colectivo("134","mixta",30);
           $medio = new MedioBoleto(); 

          $this->assertEquals(($medio->obtenerSaldo()-$colectivo->pagarCon()->tarjeta->obtenerSaldo()),7.4);
           
  }
} 
