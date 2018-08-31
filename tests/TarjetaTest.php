<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {

    /**
     * Comprueba que la tarjeta aumenta su saldo cuando se carga saldo válido.
     */
    public function testCargaSaldo() {
        $tarjeta = new Tarjeta();

        $tarjeta->recargar(10);
        $this->assertEquals($tarjeta->obtenerSaldo(), 10);

        $tarjeta->recargar(20);
        $this->assertEquals($tarjeta->obtenerSaldo(), 30);
        
        $tarjeta->recargar(30); 
        $this->assertEquals($tarjeta->obtenerSaldo(), 60); 
        
        $tarjeta->recargar(50); 
        $this->assertEquals($tarjeta->obtenerSaldo(),110);

        $tarjeta->recargar(100); 
        $this->assertEquals($tarjeta->obtenerSaldo(),210);

        $tarjeta->recargar(510.15); 
        $this->assertEquals($tarjeta->obtenerSaldo(),802.08); 

        $tarjeta->recargar(962.59);  
        $this->assertEquals($tarjeta->obtenerSaldo(),1986.25);

    }

    /**
     * Comprueba que la tarjeta no puede cargar saldos invalidos.
     */
    public function testCargaSaldoInvalido() {
      $tarjeta = new Tarjeta();

      $tarjeta->recargar(15);
      $this->assertEquals($tarjeta->obtenerSaldo(), 0);
  }


  public function testFranquiciaCompleta(){ 
      $colectivo = new Colectivo("134","mixta",30);  
      $franquicia = new FranquiciaCompleta(); 

      $this->assertEquals($franquicia->obtenerSaldo(),0.0);
      $this->assertEquals((get_class($colectivo->pagarCon($franquicia))),"Boleto");

  }

  public function testMedioBoleto(){ 
           $colectivo = new Colectivo("134","mixta",30);
           $medio = new MedioBoleto(); 
           $medio->recargar(20); 
           $colectivo->pagarCon($medio);

              $this->assertEquals( $medio->obtenerSaldo() , 12.6 );


           
  }

  public function testViajePlus() {  
    
    $colectivo = new Colectivo("134","mixta",30);
    $tarjeta = new Tarjeta(); 
    $tarjeta->recargar(10);
    
    //como la tarjeta solo tiene $10 de carga, cada vez que se invoque a la funcion pagarCon se debe incrementar en 1 la cantidad de viajes plus//
     $colectivo->pagarCon($tarjeta);
     $colectivo->pagarCon($tarjeta);


    $this->assertEquals($colectivo->pagarCon($tarjeta),"FALSE");
    //si los viajes plus funcionan correctamente, cuando querramos usar mas de 2 viajes plus la funcion pagarCon() debe retornar FALSE. En caso de que se retorne el FALSE, se verifica que solamente se pueden usar 2 viajes plus //
      
  } 

  public function testSaldoPlus(){
    
    $colectivo = new Colectivo("134","mixta",30);
    $tarjeta = new Tarjeta(); 
    $tarjeta->recargar(10);
    $tarjeta2 = new Tarjeta(); 
    $tarjeta2->recargar(10);

    $colectivo->pagarCon($tarjeta); 

    $colectivo->pagarCon($tarjeta);
    

    $colectivo->pagarCon($tarjeta2); 
    
    //creamos una tarjeta y le gastamos un viaje plus, luego le cargamos 100 y nos fijamos con el assertEquals si al hacer la carga se le restaron los 14.8 del viaje plus
   $this->assertEquals($tarjeta->recargar(100),95.2);
 
   $this->assertEquals($tarjeta2->recargar(200),180.4);
   //creamos otra tarjeta y le gastamos 2 viajes plus, luego le cargamos 200 y nos fijamos con el assertEquals si al hacer la carga se le restaron los 29.6 de los viajes plus

  }

  
} 
