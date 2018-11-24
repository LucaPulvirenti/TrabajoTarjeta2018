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
        $this->assertFalse($colectivo->pagarCon($tarjeta)); 
        //como debemos 2 viajes plus y no tenemos el saldo suficiente pagarCon debe devoler FALSE como resultado

        $tarjeta->recargar(100); 

        $boleto = $colectivo->pagarCon($tarjeta); //guardamos el ultimo boleto 

        $tarjetaMedioBoleto = new MedioBoleto($tiempo); 

        $boleto= $colectivo->pagarCon($tarjetaMedioBoleto); 

        $tiempo->Avanzar(360);//avanzamos el tiempo 6 minutos para poder pagar

        $boleto= $colectivo->pagarCon($tarjetaMedioBoleto); //pagamos 2 plus

        $tarjetaMedioBoleto->recargar(100); 

        $tiempo->Avanzar(360); 

        $boleto= $colectivo->pagarCon($tarjetaMedioBoleto); //volvemos a realizar un pago luego de deber 2 plus

        $this->assertEquals($boleto->obtenerValor(),14.8*2+7.4); //verificamos que el valor del ultimo viaje sea el correctto

       

 
    }
}
