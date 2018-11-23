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
        $this->assertEquals($tarjeta->devolverUltimoPago(),14.8);
         //$this->assertEquals($boleto->obtenerValor(),14.8); 
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

        $tarjeta3 = new FranquiciaCompleta($tiempo2); 
        $this->assertTrue($tarjeta3->pagar());       //verificamos que podamos pagar con la tarjeta
        $boleto3= $colectivo->pagarCon($tarjeta3);  
        $this->assertEquals($boleto3->obtenerTipo(),'franquicia completa'); //pagamos un boleto que cuya informacion fue almacenada en boleto 3 
        //verificamos que el boleto sea de tipo franquicia completa

        $tarjetaMedioBoleto = new MedioBoleto($tiempo2); 
        $tarjetaMedioBoleto->recargar(100); 

        $boleto= $colectivo->pagarCon($tarjetaMedioBoleto); //creamos una tarjeta y pagamos. El boleto que obtenemos como resultado lo almacenamos en la variable boleto

        $this->assertEquals($boleto->obtenerTipo(),'media franquicia estudiantil'); //verificamos que $boleto sea del tipo media franquicia estudianti.
        $this->assertEquals($boleto->valor(),7.4);
        //verificamos que el valor del pasaje que nos devuelva el boleto sea el correcto
    }
   
}
