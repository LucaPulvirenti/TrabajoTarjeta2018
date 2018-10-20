<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    public function testSaldoCero() {
        $valor = 14.80;
        $colectivo = new Colectivo("144 r","mixta",712);
        $tarjeta = new Tarjeta();
        $boleto = new Boleto($valor,$colectivo,$tarjeta,"NORMAL"," ");

        $this->assertEquals($boleto->obtenerValor(), $valor);
    }

    public function testTipoBoleto() {

        $colectivo = new Colectivo("144 r","mixta",712);
        $tarjeta = new Tarjeta();
        $boleto = $colectivo->pagarCon($tarjeta);

        $this->assertEquals($boleto->obtenerTipo(),"VIAJE PLUS");

        $tarjeta2 = new Tarjeta();
        $tarjeta2->recargar(20.0);
        $boleto2 = $colectivo->pagarCon($tarjeta2);

        $this->assertEquals($boleto2->obtenerTipo(),"NORMAL");



    }
}
