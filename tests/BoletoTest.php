<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    public function testSaldoCero() {
        $valor = 14.80;
        $colectivo = new Colectivo("144 r","mixta",712);
        $tarjeta = new Tarjeta();
        $boleto = new Boleto($valor,$colectivo,$tarjeta);

        $this->assertEquals($boleto->obtenerValor(), $valor);
    }
}
