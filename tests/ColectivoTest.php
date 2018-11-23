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
        $tiempo = new TiempoFalso(10);
    	$tarjeta = new Tarjeta($tiempo); 

        $tarjeta->recargar(20);
        $this->assertEquals(get_class($colectivo->pagarCon($tarjeta)),"TrabajoTarjeta\Boleto");

        $boleto = new Boleto($tarjeta->devolverUltimoPago(),$colectivo,$tarjeta,$tarjeta->tipotarjeta()," ");
       $boleto = $colectivo->pagarCon($tarjeta);
       //pagamos un viaje en almacenamos el boleto en la variable boleto. adeudamos un viaje plus
        $this->assertEquals($tarjeta->obtenerSaldo(),(20-14.80)); 
        $this->assertEquals($tarjeta->CantidadPlus(),1); 

        $this->assertTrue($tarjeta->pagar());
        //pagamos otro viaje por lo que adeudamos 2 viajes plus.
        $this->assertFalse($colectivo->pagarCon()); 
        //como debemos 2 viajes plus y no tenemos el saldo suficiente pagarCon debe devoler FALSE como resultado

       

 
    }
}
