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
}
