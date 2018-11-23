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

    public function testeoPagar() {
    	$colectivo = new Colectivo("134","mixta",30); 
    	$tarjeta = new Tarjeta(); 

        $tarjeta->recargar(20);
        $this->assertEquals(get_class($coletivo->pagarCon($tarjeta)),"TrabajoTarjeta/Boleto");

        $boleto = new Boleto($tarjeta->devolverUltimoPago(),$coletivo,$tarjeta,$tarjeta->tipotarjeta()," ");
       $boleto = $coletivo->pagarCon($tarjeta);
        $this->assertEquals($tarjeta->obtenerSaldo(),(20-14.80));

        $this->assertTrue($tarjeta->pagar());
        $this->assertTrue($tarjeta->pagar()); 
        //pagamos 2 viajes plus
        $this->assertFalse($colectivo->pagarCon()); 
        //como debemos 2 viajes plus y no tenemos el saldo suficiente pagarCon debe devoler FALSE como resultado

       

 
    }
}
