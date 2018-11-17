<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {
	
	 public function testSaldoCero() {
        
        $tiempo = new TiempoFalso(10); 
        $colectivo = new Colectivo("144 r","mixta",712);
        $tarjeta = new Tarjeta($tiempo);
        $tarjeta->recargar(20);
        $boleto = $colectivo->pagarCon($tarjeta);
        $this->assertEquals($boleto->obtenerValor(), $tarjeta->devolverUltimoPago());  //verificamos que el valor del viaje que nos devuelva el boleto sea igual al valor registrado en el ultimo pago de la tarjeta, que en este caso es 0. 
         $this->assertEquals($boleto->obtenerValor(),14.8); 
         $this->assertEquals($tarjeta->obtenerSaldo(),5.2); //verificamos que el ultimo pago sea de 14.8 pesos
    }
    public function testTipoBoleto() { 

    	 $tiempo2 = new TiempoFalso(10); 
        $colectivo = new Colectivo("144 r","mixta",712);
        $tarjeta = new Tarjeta($tiempo2);                      //creamos una tarjeta y un colectivo y pagamos un boleto, que en este caso sera viaje plus porque solo tenemos 10 pesos en la tarjeta
        $boleto = $colectivo->pagarCon($tarjeta);
        $this->assertEquals($boleto->obtenerTipo(),"VIAJE PLUS");  //varificamos que el boleto sea de tipo viaje plus
        $tarjeta2 = new Tarjeta($tiempo2);
        $tarjeta2->recargar(20.0);
        $boleto2 = $colectivo->pagarCon($tarjeta2);  //creamos una segunda tarjeta y pagamos un viaje normal. verificamos que este viaje sea de tipo franquicia normal
        $this->assertEquals($boleto2->obtenerTipo(),"franquicia normal");
    }
   
}
