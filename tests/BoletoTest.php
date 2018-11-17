<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {
	
	$tiempo = new TiempoFalso(10);
	$tarjeta= new Tarjeta($tiempo); 
	$tarjeta->recargar(100);                            //creamos una tarjeta le cargamos 100pesos
	$colectivo = new Colecivo("144","semtur",30); 	//creamos un colectivo	
	$boleto = $colectivo->pagarCon($tarjeta);        //pagamos un viaje con la tarjeta y lo almacenamos en la variable boleto.

	$this->assertEquals(get_class($boleto),"TrabajoTarjeta\Boleto"); //verificamos que nos hayan devuelto un boleto

   
}
