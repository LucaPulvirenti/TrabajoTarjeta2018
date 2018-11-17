<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testAlgoUtil() {
    	$coletivo = new Colectivo("144 n","mixta",20); 
 
     $this->assertEquals($coletivo->linea(),"144 n"); 
     $this->assertEquals($coletivo->empresa(),"mixta"); 
     $this->assertEquals($coletivo->numero(),20); 

    }

    public function pagar() {
    	$colectivo = new Colectivo("134","mixta",30); 
    	$tarjeta = new Tarjeta(); 

        $tarjeta->recargar(30);
        $this->assertEquals(get_class($coletivo->pagarCon($tarjeta)),"TrabajoTarjeta/Boleto");
        $coletivo->pagarCon($tarjeta);
        $this->assertEquals($tarjeta->obtenerSaldo(),(30-14.80));

 
    }
}
